<?php

namespace Muratsplat\ParesPHP;

use Dflydev\DotAccessData\Data;
use Muratsplat\ParesPHP\Exception\InvalidArgument;

class Parser
{
    /**
     * Raw paras
     * @var string
     */
    private $raw;

    /**
     * @var Pares
     */
    private $pares;

    /**
     * @var array
     */
    private $errors = [];

    /*
     *  Errors
     */
    const UNZIP_ERROR = "zlib_decode(): data error";

    /**
     * Pares constructor.
     * @param string|null $pares
     * @return self
     */
    public function __construct($pares=null)
    {
        $this->import($pares);
    }

    /**
     * @return bool
     */
    public function hasError()
    {
        return !empty($this->errors);
    }

    /**
     * @return array
     */
    public function getErrors()
    {
        return $this->errors;
    }

    /**
     * @return bool
     * @throws InvalidArgument
     */
    public function parse()
    {
        $raw = $this->getRaw();

        try {
            $decoded = static::decodeBase64($raw);

            $unZip = static::unZip($decoded);
            if ($this->isUnzipFailed()) {
                throw new InvalidArgument("Expected zip content is broken!");
            }

            $array = $this->xmlToArray($unZip);
            $this->pares = $this->mapPARes($array);
            $this->pares->setRawXML($unZip);
            return true;
        } catch (InvalidArgument $e) {
            $this->errors[] = $e->getMessage();
            return false;
        }
    }

    /**
     * @return bool
     */
    private function isUnzipFailed()
    {
        $lastError = error_get_last();
        if (empty($lastError)) {
            return false;
        }
        return in_array(static::UNZIP_ERROR, $lastError) || in_array('data error', $lastError);
    }

    /**
     * @return Pares
     */
    public function export()
    {
        if ($this->pares) {
            return $this->pares;
        }

        if ($this->parse()) {
            return $this->pares;
        }
    }

    /**
     * @param array $xmlToArray
     * @return Pares
     */
    private function mapPARes(array $xmlToArray)
    {
        $d =  new Data($xmlToArray);

        $dto = new Pares();
        $dto->setAcquirerBIN($d->get('Message.PARes.Merchant.acqBIN'));
        $dto->setMerchantID($d->get('Message.PARes.Merchant.merID'));
        $dto->setXID($d->get('Message.PARes.Purchase.xid'));
        $dto->setDate($d->get('Message.PARes.Purchase.date'));
        $dto->setAmount($d->get('Message.PARes.Purchase.purchAmount'));
        $dto->setCurrency($d->get('Message.PARes.Purchase.currency'));
        $dto->setExponent($d->get('Message.PARes.Purchase.exponent'));
        $dto->setTXTime($d->get('Message.PARes.TX.time'));
        $dto->setTXStatus($d->get('Message.PARes.TX.status'));
        $dto->setTXCAVV($d->get('Message.PARes.TX.cavv'));
        $dto->setTXECI($d->get('Message.PARes.TX.eci'));
        $dto->setTXCAVVAlgorithm($d->get('Message.PARes.TX.cavvAlgorithm'));
        return $dto;
    }

    /**
     * @param $xml
     * @return array
     */
    private function xmlToArray($xml)
    {
        $xml = simplexml_load_string($xml, "SimpleXMLElement", LIBXML_NOCDATA);
        $json = json_encode($xml);
        $array = json_decode($json,true);

        if (!empty($array)) {
            return $array;
        }

        throw new InvalidArgument("The content is not parsed as XML document !");
    }

    /**
     * @param string $pares
     */
    public function import($pares)
    {
        $this->raw = $pares;
        $this->pares = null;
    }

    /**
     * @return null|string
     * @throws InvalidArgument
     */
    private function getRaw()
    {
        if ($this->raw) {
            if (strlen($this->raw) > 1) {
                return $this->raw;
            }
        }

        throw new InvalidArgument("PARes is not set!");
    }

    /**
     * @param $string
     * @return string
     */
    private static function unZip($string)
    {
        return @zlib_decode($string);
    }

    /**
     * @param $string
     * @return string
     */
    private static function decodeBase64($string)
    {
        $decoded = base64_decode($string, true);
        if (is_bool($decoded) && false) {
            throw new InvalidArgument("PARes is not encoded by Base64!");
        }
        return $decoded;
    }
}
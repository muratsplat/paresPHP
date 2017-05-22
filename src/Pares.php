<?php

namespace Muratsplat\ParesPHP;

class Pares
{
    /**
     * @var int
     */
    private $acquirerBIN;

    /**
     * @var string
     */
    private $merchantID;

    /**
     * @var string
     */
    private $xid;

    /**
     * @var string
     */
    private $date;

    /**
     * @var int
     */
    private $amount;

    /**
     * @var int
     */
    private $currency;

    /**
     * @var int
     */
    private $exponent;

    /**
     * @var string
     */
    private $txTime;

    /**
     * @var string
     */
    private $txStatus;

    /**
     * @var string
     */
    private $txECI;

    /**
     * @var string
     */
    private $txCAVV;

    /**
     * @var int
     */
    private $txCAVVAlgorithm;

    /**
     * @var string
     */
    private $rawXml;


    /**
     * @param int $bin
     */
    public function setAcquirerBIN($bin)
    {
        $this->acquirerBIN = $bin;
    }

    /**
     * @return int
     */
    public function getAcquirerBIN()
    {
        return (int) $this->acquirerBIN;
    }

    /**
     * @param string $merchantID
     */
    public function setMerchantID($merchantID)
    {
        $this->merchantID = $merchantID;
    }

    /**
     * @return string
     */
    public function getMerchantID()
    {
        return $this->merchantID;
    }

    /**
     * @param string $XID
     */
    public function setXID($XID)
    {
        $this->xid = $XID;
    }

    /**
     * @return string|null
     */
    public function getXID()
    {
        return $this->xid;
    }

    /**
     * @param string $date
     */
    public function setDate($date)
    {
        $this->date = $date;
    }

    /**
     * @return string|null
     */
    public function getDate()
    {
        return $this->date;
    }

    /**
     * @param int $amount
     */
    public function setAmount($amount)
    {
        $this->amount = $amount;
    }

    /**
     * @return int
     */
    public function getAmount()
    {
        return (int) $this->amount;
    }

    /**
     * @param int $exponent
     */
    public function setExponent($exponent)
    {
        $this->exponent = $exponent;
    }

    /**
     * @return int
     */
    public function getExponent()
    {
        return (int) $this->exponent;
    }

    /**
     * @param int $currency
     */
    public function setCurrency($currency)
    {
        $this->currency = $currency;
    }

    /**
     * @return int
     */
    public function getCurrency()
    {
        return (int) $this->currency;
    }

    /**
     * @param int $txTime
     */
    public function setTXTime($txTime)
    {
        $this->txTime = $txTime;
    }

    /**
     * @return string
     */
    public function getTXTime()
    {
        return $this->txTime;
    }

    /**
     * @param string $txStatus
     */
    public function setTXStatus($txStatus)
    {
        $this->txStatus = $txStatus;
    }

    /**
     * @return string
     */
    public function getTXStatus()
    {
        return $this->txStatus;
    }

    /**
     * @param string $txCAVV
     */
    public function setTXCAVV($txCAVV)
    {
        $this->txCAVV = $txCAVV;
    }

    /**
     * @return string
     */
    public function getTXCAVV()
    {
        return $this->txCAVV;
    }

    /**
     * @param string $txECI
     */
    public function setTXECI($txECI)
    {
        $this->txECI = $txECI;
    }

    /**
     * @return string
     */
    public function getTXECI()
    {
        return $this->txECI;
    }

    /**
     * @param int $txCAVVAlgorithm
     */
    public function setTXCAVVAlgorithm($txCAVVAlgorithm)
    {
        $this->txCAVVAlgorithm = $txCAVVAlgorithm;
    }

    /**
     * @return int
     */
    public function getTXcavvAlgorithm()
    {
        return $this->txCAVVAlgorithm;
    }

    /**
     * @param string $string
     */
    public function setRawXML($string)
    {
        $this->rawXml = $string;
    }

    /**
     * @return string
     */
    public function getRawXML()
    {
        return $this->rawXml;
    }

    /*
     * Todo: others attributes can be mapped..
     */
}
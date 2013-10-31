<?php

namespace Boskee\EsendexBundle\Model;

use Esendex\Model\DispatchMessage;

abstract class Message
{
    protected $id;

    /**
     * @var string
     */
	protected $originator;

    /**
     * @var integer
     */
    protected $validity;

    /**
     * @var string
     */
	private $recipient;

    /**
     * @var string
     */
	private $body;

    /**
     * @var string
     */
    protected $locale = 'en-gb';

    const MessageType = '';

    /**
     * Returns the unique id.
     *
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

	public function setOriginator($originator)
	{
		$this->originator = $originator;
    
        return $this;
	}

	public function getOriginator()
	{
		return $this->originator;
	}

	public function setRecipient($recipient)
	{
		$this->recipient = $recipient;
    
        return $this;
	}

	public function getRecipient()
	{
		return $this->recipient;
	}

    public function setBody($body)
    {
        $this->body = $body;
    
        return $this;
    }

    public function getBody()
    {
        return $this->body;
    }

    public function setLocale($locale)
    {
        $supportedLocales = array(
            'en-gb' => 'English UK',
            'en-au' => 'English - Australian',
            'fr-fr' => 'French',
            'es-es' => 'Spanish',
            'de-de' => 'German'
        );

        $locale = strtolower(str_replace('_', '-', $locale));

        if (!in_array($locale, array_keys($supportedLocales)))
        {
            $localesList = array();
            foreach ($supportedLocales AS $code => $alias)
            {
                $localesList[] = sprintf("%s (%s)", $code, $alias);
            }
            throw new \Exception(sprintf("Please specify one of the supported locales: %s.", implode(", ", $localesList)));
        }

        $this->locale = $locale;
    
        return $this;
    }

    public function getLocale()
    {
        return $this->locale;
    }

    public function setValidity($validity)
    {
        $this->validity = $validity;
    
        return $this;
    }

    public function getValidity()
    {
        return $this->validity;
    }

	public function prepare()
    {
        $c = get_called_class();

    	$textMessage = new DispatchMessage(
    		$this->originator,
    		$this->recipient,
    		$this->body,
    		$c::MessageType,
    		$this->validity,
    		$this->locale
    	);

    	return $textMessage;
	}
}
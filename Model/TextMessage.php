<?php

namespace Boskee\EsendexBundle\Model;

use Esendex\Model\DispatchMessage;

class TextMessage extends Message
{
    const MessageType = DispatchMessage::SmsType;
}
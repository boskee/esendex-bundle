<?php

namespace Boskee\EsendexBundle\Model;

use Esendex\Model\DispatchMessage;

class VoiceMessage extends Message
{
    const MessageType = DispatchMessage::VoiceType;
}
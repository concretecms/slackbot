<?php
namespace Concrete5\Slackbot\Command;

use PortlandLabs\Slackbot\Bot;
use PortlandLabs\Slackbot\Command\Command;
use PortlandLabs\Slackbot\Slack\Api\Payload\ReactionsAddPayload;
use PortlandLabs\Slackbot\Slack\Rtm\Event\Message;

class HornsCommand implements Command
{

    /** @var Bot */
    protected $bot;

    public function __construct(Bot $bot)
    {
        $this->bot = $bot;
    }

    /**
     * Determine whether this command should handle a message
     *
     * @param Message $message
     *
     * @return bool
     */
    public function shouldHandle(Message $message): bool
    {
        return stripos($message->getText(), 'concrete5 rocks') !== false;
    }

    /**
     * Handle a message
     *
     * @param Message $message
     *
     * @return void
     */
    public function handle(Message $message)
    {
        $this->bot->api()->send(ReactionsAddPayload::reactTo($message, 'the_horns'));
    }
}
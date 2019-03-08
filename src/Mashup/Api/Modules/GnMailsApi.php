<?php
namespace GpsNose\SDK\Mashup\Api\Modules;

use GpsNose\SDK\Mashup\Model\GnResponseType;

class GnMailsApi extends GnApiModuleBase
{

    private const CLEAR_CACHE_PATTERNS = [
        "SendMail"
    ];

    /**
     * GnNewsApi __construct
     *
     * @param GnLoginApiBase $loginApi
     */
    public function __construct(GnLoginApiBase $loginApi)
    {
        parent::__construct($loginApi);
    }

    /**
     * Get the community-creator's mails.
     *
     * Community-targeted mails are not included, only those where community-creator is explicitly included in mail's TO.
     * Returning community-creator's mails, allows for unattended mail-automation workflows on your server.
     * User's HasNewMails flag not touched: new-mails can be seen as usual in the mobile app.
     * When a group-TO was used, you won't see it: you only known, that YOU are involved.
     *
     * @param int $lastKnownTicks
     *            The oldest known (already received) mail-ticks.
     * @param int $pageSize
     *            The maximum mails to be returned in one page. Default max is 20 items.
     * @return array(\GpsNose\SDK\Mashup\Model\GnMail) The mails page of the community-creator.
     */
    public function GetMailsPage(int $lastKnownTicks = 0, int $pageSize = null)
    {
        $result = $this->ExecuteCall("GetMailsPage", (object) [
            "lastKnownTicks" => $lastKnownTicks,
            "pageSize" => $pageSize
        ], GnResponseType::ListGnMail);

        return $result;
    }

    /**
     * Send a message from the logged-in user - or the community-creator, to the receiver.
     *
     * Sending to an explicit group-of-logins is not allowed.
     * However, you can send the message to your main- or sub-community, like: toLoginName = "%www.geohamster.com"
     * You might want to prohibit sending (SPAM..) mails to whole sub/community from your users.
     * If you're careful (controlled UI), user sending to sub/community is also a chat-technique.
     *
     * @param string $toLoginName
     *            To whom to send the message. The receiving user MUST have joined already your main or sub-community.
     * @param string $mailBody
     *            The message body.
     * @return string
     */
    public function SendMail(string $toLoginName, string $mailBody)
    {
        $result = $this->ExecuteCall("SendMail", (object) [
            "toLoginName" => $toLoginName,
            "mailBody" => $mailBody
        ], GnResponseType::Json, false, PHP_INT_MAX);

        $this->ClearCacheForActionNames(CLEAR_CACHE_PATTERNS);

        return $result;
    }
}
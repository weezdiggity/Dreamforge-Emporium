namespace App\Helpers;

use App\Models\Message;
use App\Game\Contracts\GameMessage;
use RuntimeException;

class GameMessageHelper
{
    public static function sendGameMessage(string $gameMessageClass, $player, array $params = [])
    {
        if (!is_subclass_of($gameMessageClass, GameMessage::class)) {
            throw new \InvalidArgumentException('Invalid game message class.');
        }

        try {
            $gameMessage = resolve($gameMessageClass);

            $message = new Message();
            $message->user_id = $player->id;
            $message->key = $gameMessage->getKey();
            $message->params = $params;
            $message->save();
        } catch (\Exception $e) {
            throw new RuntimeException('Could not create GameMessage instance while trying to send message.');
        }
    }
}

<?

declare(strict_types=1);

namespace App\DTO;

use Carbon\Carbon;

class PasteDTO
{
    public string $name;
    public string $content;
    public int $user_id;
    public Carbon $expires_at;
    public string $access_level;
    public string $language;
    public string $link;




    public function __construct(
        string $name,
        string $content,
        int $user_id,
        Carbon $expires_at,
        string $access_level,
        string $language,
        string $link,
    ) {
        $this->name = $name;
        $this->content = $content;
        $this->user_id = $user_id;
        $this->expires_at = $expires_at;
        $this->access_level = $access_level;
        $this->language = $language;
        $this->link = $link;
    }
}

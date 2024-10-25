<?

declare(strict_types=1);

namespace App\DTO;

class UserDTO
{
    public string $name;
    public string $email;
    public string $password;
    public int $banned;

    public function __construct(
        string $name,
        string $email,
        string $password,
        int $banned,
    ) {
        $this->name = $name;
        $this->email = $email;
        $this->password = $password;
        $this->banned = $banned;
    }
}

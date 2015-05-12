<?php namespace PetWars\Sounds;

class PrintSound implements SoundInterface
{
    /**
     * @var string
     */
    protected $sound;

    /**
     * @param string $sound
     */
    public function __construct($sound)
    {
        $this->sound = $sound;
    }

    /**
     * @return void
     */
    public function play()
    {
        echo $this->sound . ' ';
    }
}

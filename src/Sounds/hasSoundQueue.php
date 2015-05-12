<?php namespace PetWars\Sounds;

trait hasSoundQueue
{
    /**
     * @var \PetWars\Sounds\SoundInterface[]
     */
    protected $soundQueue = [];

    /**
     * @return bool
     */
    public function hasSounds()
    {
        if (empty($this->soundQueue)) {
            return false;
        }

        return true;
    }

    /**
     * @return null|true
     */
    public function playSounds()
    {
        if (!$this->hasSounds()) {
            return null;
        }

        foreach ($this->soundQueue as $sound) {
            $sound->play();
        }

        $this->soundQueue = [];

        return true;
    }

    /**
     * @param \PetWars\Sounds\SoundInterface $sound
     *
     * @return void
     */
    protected function queueSound(SoundInterface $sound)
    {
        $this->soundQueue[] = $sound;
    }
}

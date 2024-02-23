<?php

namespace FireworkCelebration;

use pocketmine\plugin\PluginBase;
use pocketmine\event\Listener;
use pocketmine\event\player\PlayerJoinEvent;
use pocketmine\world\sound\LaunchSound;
use pocketmine\world\sound\ExplodeSound;
use pocketmine\world\particle\ExplodeParticle;

class Main extends PluginBase implements Listener {

    public function onEnable(): void {
        $this->getLogger()->info("FireworkCelebration plugin has been enabled!");
        $this->getServer()->getPluginManager()->registerEvents($this, $this); // Register events
    }

    public function onPlayerJoin(PlayerJoinEvent $event): void {
        $player = $event->getPlayer();
        $position = $player->getPosition();

        // Play firework launch sound
        $player->getWorld()->addSound($position, new LaunchSound());

        // Play a generic sound
        $player->getWorld()->addSound($position, new ExplodeSound());

        // Spawn a firework particle
        $player->getWorld()->addParticle(new ExplodeParticle($position));
    }
}

<?php

namespace FireworkCelebration;

use pocketmine\plugin\PluginBase;
use pocketmine\event\Listener;
use pocketmine\event\player\PlayerJoinEvent;
use pocketmine\world\sound\LaunchSound;
use pocketmine\world\sound\ExplodeSound;

class Main extends PluginBase implements Listener {

    public function onEnable(): void {
        $this->getLogger()->info("FireworkCelebration plugin has been enabled!");
        $this->getServer()->getPluginManager()->registerEvents($this, $this); // Register events
    }

    public function onPlayerJoin(PlayerJoinEvent $event): void {
        $player = $event->getPlayer();
        $position = $player->getPosition();
        $world = $player->getWorld();

        // Play firework launch sound
        $world->addSound($position, new LaunchSound());

        // Play a generic sound
        $world->addSound($position, new ExplodeSound());
    }
}

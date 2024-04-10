<?php

namespace FireworkCelebration;

use pocketmine\plugin\PluginBase;
use pocketmine\event\Listener;
use pocketmine\event\player\PlayerJoinEvent;
use pocketmine\world\sound\LaunchSound;
use pocketmine\world\sound\ExplodeSound;
use pocketmine\utils\TextFormat;

class Main extends PluginBase implements Listener {

    public function onEnable(): void {
        $this->getLogger()->info("FireworkCelebration plugin has been enabled!");
        $this->getServer()->getPluginManager()->registerEvents($this, $this); // Register events
    }

    public function onPlayerJoin(PlayerJoinEvent $event): void {
        $player = $event->getPlayer();
        $position = $player->getPosition();
        $world = $player->getWorld();

        // Play multiple sounds for a welcoming effect
        $world->addSound($position, new LaunchSound());
        $world->addSound($position, new ExplodeSound());

        // Customize the welcome message
        $player->sendMessage(TextFormat::GREEN . "Welcome to the server, " . $player->getName() . "!");
        $player->sendMessage(TextFormat::GREEN . "Enjoy your time here!");

        // Display an animation over the player's screen
        $player->addTitle(TextFormat::AQUA . "Welcome!", TextFormat::YELLOW . "Enjoy your time here!", 20, 40, 20);
    }
}

<?php

namespace JoinAnimation;

use pocketmine\plugin\PluginBase;
use pocketmine\event\Listener;
use pocketmine\event\player\PlayerJoinEvent;
use pocketmine\world\sound\LaunchSound;
use pocketmine\world\sound\ExplodeSound;
use pocketmine\utils\TextFormat;

class Main extends PluginBase implements Listener {

    public function onEnable(): void {
        $this->saveDefaultConfig(); // Saves default config if it doesn't exist
        $this->getLogger()->info("JoinAnimation plugin has been enabled!");
        $this->getServer()->getPluginManager()->registerEvents($this, $this); // Register events
    }

    public function onPlayerJoin(PlayerJoinEvent $event): void {
        $player = $event->getPlayer();
        $config = $this->getConfig();

        // Play sounds based on config settings
        if ($config->get("sounds.launch_sound")) {
            $player->getWorld()->addSound($player->getPosition(), new LaunchSound());
        }
        if ($config->get("sounds.explode_sound")) {
            $player->getWorld()->addSound($player->getPosition(), new ExplodeSound());
        }

        // Send welcome message if enabled in config
        if ($config->get("welcome_message.enabled")) {
            $prefix = $config->get("welcome_message.prefix");
            $suffix = $config->get("welcome_message.suffix");
            $player->sendMessage(TextFormat::colorize($prefix . $player->getName() . $suffix));
        }

        // Send title if enabled in config
        if ($config->get("title.enabled")) {
            $mainTitle = $config->get("title.main_title");
            $subTitle = $config->get("title.subtitle");
            $fadeIn = $config->get("title.fade_in");
            $stay = $config->get("title.stay");
            $fadeOut = $config->get("title.fade_out");
            $player->sendTitle(
                TextFormat::colorize($mainTitle),
                TextFormat::colorize($subTitle),
                $fadeIn,
                $stay,
                $fadeOut
            );
        }
    }
}

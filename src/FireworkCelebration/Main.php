<?php

namespace FireworkCelebration;

use pocketmine\plugin\PluginBase;
use pocketmine\player\Player;
use pocketmine\item\Item;
use pocketmine\world\sound\LaunchSound;
use pocketmine\world\sound\ExplodeSound;
use pocketmine\world\particle\ExplodeParticle;
use pocketmine\entity\Entity;
use pocketmine\nbt\tag\CompoundTag;

class Main extends PluginBase {

    public function onEnable(): void {
        $this->getLogger()->info("FireworkCelebration plugin has been enabled!");
    }

    public function spawnFireworks(Player $player): void {
        // Fetch the player's position
        $position = $player->getPosition();

        // Spawn fireworks item
        $fireworks = Item::get(Item::FIREWORKS);

        // Create base NBT for entity
        $nbt = new CompoundTag("", []);

        // Create the entity
        $entity = Entity::createEntityInstance("FireworksRocketEntity", $player->getWorld(), $nbt);

        // Play firework launch sound
        $player->getWorld()->addSound($player->getPosition(), new LaunchSound());

        // Play a generic sound
        $player->getWorld()->addSound($player->getPosition(), new ExplodeSound());

        // Spawn a firework particle
        $player->getWorld()->addParticle(new ExplodeParticle($position));
    }
}

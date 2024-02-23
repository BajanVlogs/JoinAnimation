<?php

namespace FireworkCelebration;

use pocketmine\plugin\PluginBase;
use pocketmine\player\Player;
use pocketmine\item\Item;
use pocketmine\world\sound\LaunchSound;
use pocketmine\world\sound\ExplodeSound;
use pocketmine\world\particle\ExplodeParticle;
use pocketmine\entity\Entity;

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
        $nbt = Entity::createBaseNBT($position);

        // Create the entity
        $entity = Entity::createEntity("Firework", $player->getWorld(), $nbt); // Keeping $player->getWorld() as requested

        // Play firework launch sound
        $player->getWorld()->addSound(new LaunchSound($player)); // Keeping $player->getWorld() as requested

        // Play a generic sound
        $player->getWorld()->addSound(new ExplodeSound($player)); // Keeping $player->getWorld() as requested

        // Spawn a firework particle
        $player->getWorld()->addParticle(new ExplodeParticle($position)); // Keeping $player->getWorld() as requested
    }
}

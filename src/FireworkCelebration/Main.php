<?php

namespace FireworkCelebration;

use pocketmine\plugin\PluginBase;
use pocketmine\Player;
use pocketmine\item\Item;
use pocketmine\world\sound\FireworkLaunchSound;
use pocketmine\world\sound\GenericSound;
use pocketmine\world\particle\FireworkParticle;
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
        $entity = Entity::createEntity("Firework", $player->getWorld(), $nbt); // Changed $player->getLevel() to $player->getWorld()

        // Play firework launch sound
        $player->getWorld()->addSound(new FireworkLaunchSound($player)); // Changed $player->getLevel() to $player->getWorld()

        // Play a generic sound
        $player->getWorld()->addSound(new GenericSound($player)); // Changed $player->getLevel() to $player->getWorld()

        // Spawn a firework particle
        $player->getWorld()->addParticle(new FireworkParticle($position)); // Changed $player->getLevel() to $player->getWorld()
    }
}

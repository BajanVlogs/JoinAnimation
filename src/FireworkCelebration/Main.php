<?php

namespace FireworkCelebration;

use pocketmine\plugin\PluginBase;
use pocketmine\Player;
use pocketmine\item\Item;
use pocketmine\level\sound\FireworkLaunchSound;
use pocketmine\level\sound\GenericSound;
use pocketmine\level\particle\FireworkParticle;
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
        $entity = Entity::createEntity("Firework", $player->getLevel(), $nbt);

        // Play firework launch sound
        $player->getLevel()->addSound(new FireworkLaunchSound($player));

        // Play a generic sound
        $player->getLevel()->addSound(new GenericSound($player));

        // Spawn a firework particle
        $player->getLevel()->addParticle(new FireworkParticle($position));
    }
}

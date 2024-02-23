<?php

namespace FireworkCelebration;

use pocketmine\plugin\PluginBase;
use pocketmine\event\Listener;
use pocketmine\event\player\PlayerJoinEvent;
use pocketmine\math\Vector3;
use pocketmine\level\Position;
use pocketmine\level\sound\FireworkLaunchSound;
use pocketmine\level\sound\ClickSound;
use pocketmine\level\sound\GenericSound;
use pocketmine\level\particle\FireworkParticle;
use pocketmine\Player;
use pocketmine\item\Item;
use pocketmine\entity\Entity;
use pocketmine\scheduler\ClosureTask;

class Main extends PluginBase implements Listener {

    public function onEnable() {
        $this->getLogger()->info("FireworkCelebration enabled!");
        $this->getServer()->getPluginManager()->registerEvents($this, $this);
    }

    public function onPlayerJoin(PlayerJoinEvent $event) {
        $player = $event->getPlayer();
        $this->spawnFireworks($player);
    }

    private function spawnFireworks(Player $player) {
        $level = $player->getLevel();
        $pos = $player->getPosition();

        $firework = Item::get(Item::FIREWORKS, 0, 1);
        $nbt = Entity::createBaseNBT($pos, new Vector3(0.001, 0.05, 0.001), mt_rand(0, 359), 0);
        $fireworkEntity = Entity::createEntity("FireworksRocket", $level, $nbt, $firework);
        $fireworkEntity->setOwningEntity($player);
        $fireworkEntity->spawnToAll();

        $level->addSound(new FireworkLaunchSound($pos), [$player]);
        $level->addSound(new GenericSound($pos, 40), [$player]); // Sound ID for ENTITY_FIREWORK_LAUNCH
        $level->addParticle(new FireworkParticle(new Vector3($pos->x, $pos->y, $pos->z)));

        // Schedule fireworks to last for 5 seconds
        $this->getScheduler()->scheduleDelayedTask(new ClosureTask(function (int $currentTick) use ($fireworkEntity) {
            if (!$fireworkEntity->isClosed()) {
                $fireworkEntity->close();
            }
        }), 100); // 100 ticks = 5 seconds (20 ticks per second)
    }
}

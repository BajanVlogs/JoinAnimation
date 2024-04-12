<?php
 
namespace JoinAnimation\commands\subcommands;

use pocketmine\player\Player;

use pocketmine\command\CommandSender;

use CortexPE\Commando\BaseSubCommand;

use JoinAnimation\Loader;
use JoinAnimation\utils\PluginUtils;
use JoinAnimation\utils\SpawnUtils;

class SpawnSubCommand extends BaseSubCommand{

    public function __construct(){
        parent::__construct("setspawn", "§r§fDefining custom JoinAnimation spawn by §bBajanVlogs", ["setjoin"]);
        $this->setPermission("joinanimation.command.setspawn");
    }
    /**
     * @return void
     */
    protected function prepare(): void{
    }

    /**
     * @param CommandSender $sender
     * @param string $aliasUsed
     * @param array $args
     * @return void
     */
    public function onRun(CommandSender $sender, string $aliasUsed, array $args): void{
        if(!$sender instanceof Player){
            $sender->sendMessage("Use this command in-game");
            return;
        }

        if(!$sender->hasPermission("joinanimation.command")){
            $sender->sendMessage(Loader::Prefix(). Loader::getMessage($sender, "Messages.no-permission"));
            PluginUtils::PlaySound($sender, "mob.villager.no", 1, 1);
            return;
        }

        SpawnUtils::setSpawn($sender);
    }
}

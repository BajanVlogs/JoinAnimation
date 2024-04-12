<?php
    
namespace JoinAnimation\commands;

use pocketmine\player\Player;

use CortexPE\Commando\BaseCommand;
use JoinAnimation\commands\subcommands\RemoveSpawnSubCommand;
use JoinAnimation\commands\subcommands\SpawnSubCommand;
use Vecnavium\FormsUI\SimpleForm;

use pocketmine\command\CommandSender;

use JoinAnimation\Loader;
use JoinAnimation\forms\JoinForm;
use JoinAnimation\utils\PluginUtils;

class JoinCommand extends BaseCommand{

    public function __construct(){
        parent::__construct(Loader::getInstance(), "joinanimation", "§r§fOpen menu JoinAnimation to view your welcome by §bBajanVlogs", ["join"]);
        $this->setPermission("joinanimation.command");
    }
    /**
     * @return void
     */
    protected function prepare(): void{
        $this->registerSubCommand(new SpawnSubCommand("setspawn", "§r§fDefining custom JoinAnimation spawn by §bBajanVlogs", ["setjoin"]));
        $this->registerSubCommand(new RemoveSpawnSubCommand("removespawn", "§r§fRemover custom JoinAnimation spawn by §bBajanVlogs", ["removejoin"]));
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

        $form = new SimpleForm(function(Player $player, $data){
            if($data === null){
                PluginUtils::PlaySound($player, "random.pop2", 1, 1.5);
                return true;
            }
            switch($data){
                case 0: // FormUI
                    JoinForm::getJoinUI($player);
                    PluginUtils::PlaySound($player, "random.pop", 1, 1.5);
                break;

                case 1: // BooKUI
                    JoinForm::getJoinBookUI($player);
                    PluginUtils::PlaySound($player, "random.pop", 1, 1.5);
                break;

                case 2:
                break;
            }
        });
        $form->setTitle("§l§9JoinAnimation");
        $form->addButton("FormUI");
        $form->addButton("BookUI");
        $form->addButton("Close menu");
        $sender->sendForm($form);
    }
}

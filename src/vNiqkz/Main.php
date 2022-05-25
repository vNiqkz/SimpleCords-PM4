<?php
namespace vNiqkz;
use pocketmine\plugin\PluginBase;
use pocketmine\event\Listener;
use pocketmine\event\player\PlayerJoinEvent;
use pocketmine\network\mcpe\protocol\GameRulesChangedPacket;
use pocketmine\network\mcpe\protocol\types\BoolGameRule;
use pocketmine\utils\Config;
class Main extends PluginBase implements Listener{
    public function onEnable(): void{
        $this->getServer()->getPluginManager()->registerEvents($this, $this);
    }
    public static function getConfiguration($name){
      return new Config($this->getDataFoolder().$name.".yml", Config::YAML);
    }
    public static function activate($player): void{
      
    }
    public static function getStatusPlayer(String $playerName){
      return Main::getConfiguration("player")->get($playerName);
    }
    public function onPlayerJoin(PlayerJoinEvent $event): void{
      
        $player = $event->getPlayer();
        $statusPlayer = Main::getStatusPlayer($player->getName())
        if($statusPlayer){
          $pk = new GameRulesChangedPacket();
		      $pk->gameRules = ["showcoordinates" => new BoolGameRule(true, false)];
          $player->getNetworkSession()->sendDataPacket($pk);
        }
    	  
    }
}
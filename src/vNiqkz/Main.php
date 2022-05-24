<?php
namespace vNiqkz;
use pocketmine\plugin\PluginBase;
use pocketmine\event\Listener;
use pocketmine\event\player\PlayerJoinEvent;
use pocketmine\network\mcpe\protocol\GameRulesChangedPacket;
use pocketmine\network\mcpe\protocol\types\BoolGameRule;
class Main extends PluginBase implements Listener{
    public function onEnable(): void{
        $this->getServer()->getPluginManager()->registerEvents($this, $this);
    }
    public function onPlayerJoin(PlayerJoinEvent $event): void{
        $player = $event->getPlayer();
    	$pk = new GameRulesChangedPacket();
		$pk->gameRules = ["showcoordinates" => new BoolGameRule(true, false)];
        $player->getNetworkSession()->sendDataPacket($pk);
    }
}
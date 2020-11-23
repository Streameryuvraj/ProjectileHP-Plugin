<?php

declare(strict_types=1);
namespace clearskyteam;

use pocketmine\Player;
use pocketmine\plugin\PluginBase;
use pocketmine\event\Listener;
use pocketmine\utils\Config;
use pocketmine\event\entity\EntityDamageEvent;
use pocketmine\event\entity\EntityDamageByEntityEvent;
use pocketmine\math\Vector3;
use pocketmine\level\sound\BlazeShootSound;

class Main extends PluginBase implements Listener {
	
	// —————————— Enable and Disable Logger —————————— //

	public function onEnable() : void{
		$this->getLogger()->notice("is activated!");
		$this->getLogger()->notice("Plugin Author: @StreamerYuvraj");
		$this->getServer()->getPluginManager()->registerEvents($this, $this);
	}
	
	public function onDisable() : void{
		$this->getLogger()->notice("is deactivated!");
	}
	
	// —————————— Show Health and Play Sound on Projectile Hit! —————————— //
	
	public function onHit(EntityDamageEvent $event){
	 if ($event->getCause() === EntityDamageByEntityEvent::CAUSE_PROJECTILE){
			$player = $event->getDamager();
			$level = $player->getLevel();
			if($player instanceof Player){
				$health = $event->getEntity()->getHealth();
				$entity = $event->getEntity()->getNameTag();
				$player->sendMessage("§e" . $entity . " §cis now at§6 " . $health . " §cHP");
				$level->addSound(new BlazeShootSound($player->asVector3()));

			}
		}
	}
}

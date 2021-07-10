<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use App\Entity\PolyGardeUser;

class PolyGardeUserFixtures extends Fixture
{
	
	private $passwordEncoder;
	
	public function __construct(UserPasswordEncoderInterface $passwordEncoder)
	{
	
		$this->passwordEncoder = $passwordEncoder;
		
	}
    public function load(ObjectManager $manager)
	{
		$user = new PolyGardeUser();
		
		$password = $this->passwordEncoder->encodePassword(
		$user, 
		'98512143');
		
        $user->setUsername("fahed_s");
        $user->setNom("fahed");
        $user->setPrenom("selmi");
        $user->setPassword($password);
        $user->setEmail("fahed@selmi.com");
        $user->setCin("11393163");
        $user->setRoles(['ROLE_RACL']);
        $user->setTel("55972953");
        $manager->persist($user);

        $manager->flush();
    }
}

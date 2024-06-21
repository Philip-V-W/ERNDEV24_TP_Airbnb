<?php

namespace App;

use App\Repository\AddressRepository;
use App\Repository\EquipmentRepository;
use App\Repository\FavoriteRepository;
use App\Repository\MediaRepository;
use App\Repository\ReservationRepository;
use App\Repository\ResidenceEquipmentRepository;
use App\Repository\ResidenceRepository;
use App\Repository\TypeRepository;
use App\Repository\UserRepository;
use Core\Repository\RepositoryManagerTrait;

class AppRepoManager
{
    use RepositoryManagerTrait;

    private AddressRepository $addressRepository;
    private EquipmentRepository $equipmentRepository;
    private FavoriteRepository $favoriteRepository;
    private MediaRepository $mediaRepository;
    private ReservationRepository $reservationRepository;
    private ResidenceEquipmentRepository $residenceEquipmentRepository;
    private ResidenceRepository $residenceRepository;
    private TypeRepository $typeRepository;
    private UserRepository $userRepository;

    public function getAddressRepository(): AddressRepository
    {
        return $this->addressRepository;
    }

    public function getEquipmentRepository(): EquipmentRepository
    {
        return $this->equipmentRepository;
    }

    public function getFavoriteRepository(): FavoriteRepository
    {
        return $this->favoriteRepository;
    }

    public function getMediaRepository(): MediaRepository
    {
        return $this->mediaRepository;
    }

    public function getReservationRepository(): ReservationRepository
    {
        return $this->reservationRepository;
    }

    public function getResidenceEquipmentRepository(): ResidenceEquipmentRepository
    {
        return $this->residenceEquipmentRepository;
    }

    public function getResidenceRepository(): ResidenceRepository
    {
        return $this->residenceRepository;
    }

    public function getTypeRepository(): TypeRepository
    {
        return $this->typeRepository;
    }

    public function getUserRepository(): UserRepository
    {
        return $this->userRepository;
    }

    // Protected constructor to prevent creating a new instance of the AppRepoManager via the `new` operator from outside of this class.
    protected function __construct()
    {
        $config = App::getApp();

        $this->addressRepository = new AddressRepository($config);
        $this->equipmentRepository = new EquipmentRepository($config);
        $this->favoriteRepository = new FavoriteRepository($config);
        $this->mediaRepository = new MediaRepository($config);
        $this->reservationRepository = new ReservationRepository($config);
        $this->residenceEquipmentRepository = new ResidenceEquipmentRepository($config);
        $this->residenceRepository = new ResidenceRepository($config);
        $this->typeRepository = new TypeRepository($config);
        $this->userRepository = new UserRepository($config);
    }
}

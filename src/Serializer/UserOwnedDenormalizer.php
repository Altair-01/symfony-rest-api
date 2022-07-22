<?php

namespace App\Serializer;

use App\Entity\UserOwnedInterface;
use Symfony\Component\Serializer\Normalizer\DenormalizerInterface;
use Symfony\Component\Serializer\Exception\ExceptionInterface;
use Symfony\Component\Serializer\Exception\BadMethodCallException;
use Symfony\Component\Serializer\Exception\ExtraAttributesException;
use Symfony\Component\Serializer\Exception\InvalidArgumentException;
use Symfony\Component\Serializer\Exception\LogicException;
use Symfony\Component\Serializer\Exception\RuntimeException;
use Symfony\Component\Serializer\Exception\UnexpectedValueException;
use Symfony\Component\Serializer\Normalizer\DenormalizerAwareInterface;
use Symfony\Component\Security\Core\Security;
use Symfony\Component\Serializer\Normalizer\DenormalizerAwareTrait;

class UserOwnedDenormalizer implements DenormalizerInterface,DenormalizerAwareInterface{

    use DenormalizerAwareTrait;

    private const ALREADY_CALLED_DENORMALIZER = 'UserOwnedDenormalizer';

    public function __construct(private Security $security)
    {
        
    }

    public function supportsDenormalization($data, string $type, string $format  = null, array $context = [])
    {
        $reflectionClass = new \ReflectionClass($type);
        $alreadyCalled = $context[self::ALREADY_CALLED_DENORMALIZER] ?? false;
        return $reflectionClass->implementsInterface(UserOwnedInterface::class) && $alreadyCalled === false;
    }

    public function denormalize($data,string $type,string $format = null, array $context = []){
        $context[self::ALREADY_CALLED_DENORMALIZER] = true;
        /** @var UserOwnedInterface $obj */
        $obj = $this->denormalizer->denormalize($data, $type, $format, $context);
        $obj->setUser($this->security->getUser());
        return($obj);
    }
}
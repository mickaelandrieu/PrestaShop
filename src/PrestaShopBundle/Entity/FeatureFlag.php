<?php
/**
 * Copyright since 2007 PrestaShop SA and Contributors
 * PrestaShop is an International Registered Trademark & Property of PrestaShop SA
 *
 * NOTICE OF LICENSE
 *
 * This source file is subject to the Open Software License (OSL 3.0)
 * that is bundled with this package in the file LICENSE.md.
 * It is also available through the world-wide-web at this URL:
 * https://opensource.org/licenses/OSL-3.0
 * If you did not receive a copy of the license and are unable to
 * obtain it through the world-wide-web, please send an email
 * to license@prestashop.com so we can send you a copy immediately.
 *
 * DISCLAIMER
 *
 * Do not edit or add to this file if you wish to upgrade PrestaShop to newer
 * versions in the future. If you wish to customize PrestaShop for your
 * needs please refer to https://devdocs.prestashop.com/ for more information.
 *
 * @author    PrestaShop SA and Contributors <contact@prestashop.com>
 * @copyright Since 2007 PrestaShop SA and Contributors
 * @license   https://opensource.org/licenses/OSL-3.0 Open Software License (OSL 3.0)
 */

declare(strict_types=1);

namespace PrestaShopBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use InvalidArgumentException;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

/**
 * @ORM\Entity()
 * @ORM\Table()
 * @UniqueEntity("name")
 */
class FeatureFlag
{
    /**
     * @var int
     *
     * @ORM\Id
     * @ORM\Column(name="id_feature_flag", type="integer", options={"unsigned"=true})
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=255, unique=true)
     */
    private $name;

    /**
     * @var bool
     *
     * @ORM\Column(name="state", type="boolean", options={"default":0, "unsigned"=true})
     */
    private $state;

    /**
     * @var string
     *
     * @ORM\Column(name="description_wording", type="string", length=255, options={"default":""})
     */
    private $descriptionWording;

    /**
     * @var string
     *
     * @ORM\Column(name="description_wording_domain", type="string", length=255, options={"default":""})
     */
    private $descriptionWordingDomain;

    /**
     * @param string $name
     */
    public function __construct(string $name)
    {
        if (!$name) {
            throw new InvalidArgumentException('Feature flag name cannot be empty');
        }
        $this->name = $name;
        $this->state = false;
        $this->descriptionWording = '';
        $this->descriptionWordingDomain = '';
    }

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @return bool
     */
    public function getState(): bool
    {
        return $this->state;
    }

    public function disable(): void
    {
        $this->state = false;
    }

    public function enable(): void
    {
        $this->state = true;
    }

    /**
     * @return string
     */
    public function getDescriptionWording(): string
    {
        return $this->descriptionWording;
    }

    /**
     * @param string $descriptionWording
     */
    public function setDescriptionWording(string $descriptionWording): void
    {
        $this->descriptionWording = $descriptionWording;
    }

    /**
     * @return string
     */
    public function getDescriptionWordingDomain(): string
    {
        return $this->descriptionWordingDomain;
    }

    /**
     * @param string $descriptionWordingDomain
     */
    public function setDescriptionWordingDomain(string $descriptionWordingDomain): void
    {
        $this->descriptionWordingDomain = $descriptionWordingDomain;
    }
}

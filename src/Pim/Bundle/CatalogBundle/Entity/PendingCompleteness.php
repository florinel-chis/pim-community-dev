<?php

namespace Pim\Bundle\CatalogBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Pim\Bundle\CatalogBundle\Entity\Locale;
use Pim\Bundle\CatalogBundle\Entity\Channel;
use Pim\Bundle\CatalogBundle\Entity\Family;

/**
 * Product completeness to re-calculate
 *
 * @author    Nicolas Dupont <nicolas@akeneo.com>
 * @copyright 2013 Akeneo SAS (http://www.akeneo.com)
 * @license   http://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0)
 *
 * @ORM\Entity(
 *     repositoryClass="Pim\Bundle\CatalogBundle\Entity\Repository\PendingCompletenessRepository"
 * )
 * @ORM\Table(name="pim_catalog_pending_completeness")
 */
class PendingCompleteness
{
    /**
     * @var integer $id
     *
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    protected $id;

    /**
     * @var Locale $locale
     *
     * @ORM\ManyToOne(targetEntity="Pim\Bundle\CatalogBundle\Entity\Locale")
     */
    protected $locale;

    /**
     * @var Channel $channel
     *
     * @ORM\ManyToOne(targetEntity="Pim\Bundle\CatalogBundle\Entity\Channel")
     * @ORM\JoinColumn(name="channel_id", referencedColumnName="id", onDelete="CASCADE")
     */
    protected $channel;

    /**
     * @var Family $family
     *
     * @ORM\ManyToOne(targetEntity="Pim\Bundle\CatalogBundle\Entity\Family")
     */
    protected $family;

    /**
     * Getter locale
     *
     * @return Locale
     */
    public function getLocale()
    {
        return $this->locale;
    }

    /**
     * Setter locale
     *
     * @param Locale $locale
     *
     * @return PendingCompleteness
     */
    public function setLocale(Locale $locale)
    {
        $this->locale = $locale;

        return $this;
    }

    /**
     * Getter channel
     *
     * @return Channel
     */
    public function getChannel()
    {
        return $this->channel;
    }

    /**
     * Setter channel
     *
     * @param Channel $channel
     *
     * @return PendingCompleteness
     */
    public function setChannel(Channel $channel)
    {
        $this->channel = $channel;

        return $this;
    }

    /**
     * Getter family
     *
     * @return Family
     */
    public function getFamily()
    {
        return $this->family;
    }

    /**
     * Setter family
     *
     * @param Family $family
     *
     * @return PendingCompleteness
     */
    public function setFamily(Family $family)
    {
        $this->family = $family;

        return $this;
    }
}

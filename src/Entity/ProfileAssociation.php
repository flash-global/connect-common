<?php

namespace Fei\Service\Connect\Common\Entity;

use Fei\Entity\AbstractEntity;

/**
 * Class ProfileAssociation
 *
 * @Entity
 * @Table(
 *     name="profiles_association",
 *     uniqueConstraints={
 *        @UniqueConstraint(
 *                  name="profileAssociation_unique",
 *                  columns={"user_id", "application_id", "profile", "role"}
 *        )},
 *      indexes={@Index(name="profile_idx", columns={"profile"})}
 * )
 *
 * @package Fei\Service\Connect\Common\Entity
 */
class ProfileAssociation extends AbstractEntity
{
    /**
     * @var int $id
     *
     * @Id
     * @Column(type="integer")
     * @GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @var User $user
     *
     * @ManyToOne(targetEntity="User", inversedBy="profileAssociations")
     * @JoinColumn(name="user_id", referencedColumnName="id", nullable=false)
     */
    protected $user;

    /**
     * @var Application $application
     *
     * @ManyToOne(targetEntity="Application")
     * @JoinColumn(name="application_id", referencedColumnName="id", nullable=false)
     */
    protected $application;

    /**
     * @var string $profile
     *
     * @Column(type="string", length=255)
     */
    protected $profile;

    /**
     * @var string $role
     *
     * @Column(type="string", length=255)
     */
    protected $role;

    /**
     * GET Id
     *
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * SET Id
     *
     * @param int $id
     * @return ProfileAssociation
     */
    public function setId(int $id)
    {
        $this->id = $id;
        return $this;
    }

    /**
     * GET User
     *
     * @return User
     */
    public function getUser(): User
    {
        return $this->user;
    }

    /**
     * SET User
     *
     * @param User $user
     * @return ProfileAssociation
     */
    public function setUser(User $user): ProfileAssociation
    {
        $this->user = $user;

        return $this;
    }

    /**
     * GET Application
     *
     * @return Application
     */
    public function getApplication(): Application
    {
        return $this->application;
    }

    /**
     * SET Application
     *
     * @param Application $application
     * @return ProfileAssociation
     */
    public function setApplication(Application $application): ProfileAssociation
    {
        $this->application = $application;

        return $this;
    }

    /**
     * Get Profile
     *
     * @return string
     */
    public function getProfile(): string
    {
        return $this->profile;
    }

    /**
     * Set Profile
     *
     * @param string $profile
     * @return ProfileAssociation
     */
    public function setProfile(string $profile): ProfileAssociation
    {
        $this->profile = $profile;

        return $this;
    }

    /**
     * Get Role
     *
     * @return string
     */
    public function getRole(): string
    {
        return $this->role;
    }

    /**
     * Set Role
     *
     * @param string $role
     */
    public function setRole(string $role): ProfileAssociation
    {
        $this->role = $role;

        return $this;
    }

    public function toArray($mapped = false)
    {
        return [
            'user' => $this->user->getId(),
            'application' => $this->application->getId(),
            'profile' => $this->profile,
            'role' => $this->role
        ];
    }
}

<?php

namespace Fei\Service\Connect\Common\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Fei\Service\Connect\Common\Transformer\ApplicationGroupMinimalTransformer;
use Fei\Service\Connect\Common\Transformer\ApplicationMinimalTransformer;
use Fei\Service\Connect\Common\Transformer\DefaultRoleMinimalTransformer;
use Zend\Permissions\Acl\Role\RoleInterface;

/**
 * Class User
 *
 * @Entity
 * @Table(name="users")
 *
 * @package Fei\Service\Connect\Common\Entity
 */
class User extends AbstractSource implements RoleInterface
{
    const USER_NAME = 'user_name';
    const REGISTER_TOKEN = 'register_token';
    const STATUS = 'status';

    const STATUS_PENDING = 1;
    const STATUS_ACTIVE = 2;
    const STATUS_SUSPENDED = 3;
    const STATUS_DELETED = 0;

    /**
     * @Column(type="datetime")
     *
     * @var \DateTime
     */
    protected $createdAt;

    /**
     * @Column(type="string", unique=true)
     *
     * @var string
     */
    protected $userName;

    /**
     * @var string
     */
    protected $password;

    /**
     * @Column(type="string", nullable=true)
     *
     * @var string
     */
    protected $firstName;

    /**
     * @Column(type="string", nullable=true)
     *
     * @var string
     */
    protected $lastName;

    /**
     * @Column(type="string", nullable=true, unique=true)
     *
     * @var string
     */
    protected $email;

    /**
     * @Column(type="integer")
     *
     * @var int
     */
    protected $status = self::STATUS_PENDING;

    /**
     * @Column(type="guid", nullable=true, unique=true)
     *
     * @var string
     */
    protected $registerToken;

    /**
     * @var string
     */
    protected $currentRole;

    /**
     * @var string
     */
    protected $localUsername;

    /**
     * @var Attribution;
     */
    protected $currentAttribution;

    /**
     * @var ArrayCollection
     */
    protected $foreignServicesIds;

    /**
     * @Column(type="string", nullable=true)
     *
     * @var string
     */
    protected $avatarUrl;

    /**
     * @Column(type="string", nullable=true)
     *
     * @var string
     */
    protected $miniAvatarUrl;

    /**
     * @Column(type="string", options={"default":"en"})
     *
     * @var string
     */
    protected $language;

    /**
     * @ManyToMany(targetEntity="UserGroup", inversedBy="users")
     * @JoinTable(name="users_has_groups")
     *
     * @var Collection|UserGroup[]
     */
    protected $userGroups;

    /**
     * @OneToMany(targetEntity="DefaultRole", mappedBy="user")
     *
     * @var Collection|DefaultRole[]
     */
    protected $defaultRoles;

    /**
     * User constructor.
     *
     * @param array $data
     */
    public function __construct($data = null)
    {
        $this->setForeignServicesIds(new ArrayCollection());
        $this->setUserGroups(new ArrayCollection());
        $this->setDefaultRoles(new ArrayCollection());
        $this->setCreatedAt(new \DateTime());
        $this->setLanguage('en');

        parent::__construct($data);
    }

    /**
     * Get UserName
     *
     * @return string
     */
    public function getUserName()
    {
        return $this->userName;
    }

    /**
     * Set UserName
     *
     * @param string $userName
     *
     * @return $this
     */
    public function setUserName($userName)
    {
        $this->userName = $userName;

        return $this;
    }

    /**
     * Get Password
     *
     * @return string
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * Set Password
     *
     * @param string $password
     *
     * @return $this
     */
    public function setPassword($password)
    {
        $this->password = $password;

        return $this;
    }

    /**
     * Get CreatedAt
     *
     * @return \DateTime
     */
    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    /**
     * Set CreatedAt
     *
     * @param \DateTime|string $createdAt
     *
     * @return $this
     */
    public function setCreatedAt($createdAt)
    {
        $this->createdAt = $createdAt instanceof \DateTime ? $createdAt : new \DateTime($createdAt);

        return $this;
    }

    /**
     * Get Status
     *
     * @return int
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * Set Status
     *
     * @param int $status
     *
     * @return $this
     */
    public function setStatus($status)
    {
        $this->status = $status;

        return $this;
    }

    /**
     * Get FirstName
     *
     * @return string
     */
    public function getFirstName()
    {
        return $this->firstName;
    }

    /**
     * Set FirstName
     *
     * @param string $firstName
     *
     * @return $this
     */
    public function setFirstName($firstName)
    {
        $this->firstName = $firstName;

        return $this;
    }

    /**
     * Get LastName
     *
     * @return string
     */
    public function getLastName()
    {
        return $this->lastName;
    }

    /**
     * Set LastName
     *
     * @param string $lastName
     *
     * @return User
     */
    public function setLastName($lastName)
    {
        $this->lastName = $lastName;

        return $this;
    }

    /**
     * Get Email
     *
     * @return string
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Set Email
     *
     * @param string $email
     *
     * @return $this
     */
    public function setEmail($email)
    {
        $this->email = $email;

        return $this;
    }

    /**
     * Get RegisterToken
     *
     * @return string
     */
    public function getRegisterToken()
    {
        return $this->registerToken;
    }

    /**
     * Set RegisterToken
     *
     * @param string $registerToken
     *
     * @return $this
     */
    public function setRegisterToken($registerToken)
    {
        $this->registerToken = $registerToken;

        return $this;
    }

    /**
     * Get CurrentRole
     *
     * @return string
     */
    public function getCurrentRole()
    {
        return $this->currentRole;
    }

    /**
     * Set CurrentRole
     *
     * @param string $currentRole
     *
     * @return $this
     */
    public function setCurrentRole($currentRole)
    {
        $this->currentRole = $currentRole;

        return $this;
    }

    /**
     * Get LocalUsername
     *
     * @return string
     */
    public function getLocalUsername()
    {
        return $this->localUsername;
    }

    /**
     * Set LocalUsername
     *
     * @param string $localUsername
     *
     * @return $this
     */
    public function setLocalUsername($localUsername)
    {
        $this->localUsername = $localUsername;

        return $this;
    }

    /**
     * Get CurrentAttribution
     *
     * @return Attribution
     */
    public function getCurrentAttribution()
    {
        return $this->currentAttribution;
    }

    /**
     * Set CurrentAttribution
     *
     * @param Attribution|null $currentAttribution
     *
     * @return $this
     */
    public function setCurrentAttribution($currentAttribution)
    {
        $this->currentAttribution = $currentAttribution;
        return $this;
    }

    /**
     * Add ForeignServiceId
     *
     * @param ForeignServiceId ...$foreignServiceId
     *
     * @return $this
     */
    public function addForeignServiceId(ForeignServiceId ...$foreignServiceId)
    {
        foreach ($foreignServiceId as $item) {
            $this->getForeignServicesIds()->add($item);
        }

        return $this;
    }

    /**
     * Remove ForeignServiceId
     *
     * @param string $foreignServiceName
     *
     * @return $this
     */
    public function removeForeignServiceId($foreignServiceName)
    {
        /**
         * @var ForeignServiceId $foreignServiceId
         */
        foreach ($this->foreignServicesIds as $key => $foreignServiceId) {
            if ($foreignServiceId->getName() === $foreignServiceName) {
                $this->foreignServicesIds->remove($key);
            }
        }

        return $this;
    }

    /**
     * get ForeignServicesIds
     *
     * @return ArrayCollection
     */
    public function getForeignServicesIds()
    {
        if (is_null($this->foreignServicesIds)) {
            $this->foreignServicesIds = new ArrayCollection();
        }

        return $this->foreignServicesIds;
    }

    /**
     * Set ForeignServicesIds
     *
     * @param Collection $foreignServicesIds
     *
     * @return User
     */
    public function setForeignServicesIds(Collection $foreignServicesIds)
    {
        $this->foreignServicesIds = $foreignServicesIds;

        return $this;
    }

    /**
     * Get AvatarUrl
     *
     * @return string
     */
    public function getAvatarUrl()
    {
        return $this->avatarUrl;
    }

    /**
     * Set AvatarUrl
     *
     * @param string $avatarUrl
     *
     * @return User
     */
    public function setAvatarUrl($avatarUrl = null)
    {
        $this->avatarUrl = $avatarUrl;

        return $this;
    }

    /**
     * Get MiniAvatarUrl
     *
     * @return string
     */
    public function getMiniAvatarUrl()
    {
        return $this->miniAvatarUrl;
    }

    /**
     * Set MiniAvatarUrl
     *
     * @param string $miniAvatarUrl
     *
     * @return User
     */
    public function setMiniAvatarUrl($miniAvatarUrl = null)
    {
        $this->miniAvatarUrl = $miniAvatarUrl;

        return $this;
    }

    /**
     * Get Language
     *
     * @return string
     */
    public function getLanguage()
    {
        return $this->language;
    }

    /**
     * Set Language
     *
     * @param string $language
     *
     * @return $this
     */
    public function setLanguage($language)
    {
        $this->language = $language;
        return $this;
    }

    /**
     * Get UserGroups
     *
     * @return Collection|UserGroup[]
     */
    public function getUserGroups(): Collection
    {
        return $this->userGroups;
    }

    /**
     * Set UserGroups
     *
     * @param Collection|UserGroup[] $userGroups
     *
     * @return $this
     */
    public function setUserGroups(Collection $userGroups)
    {
        $this->userGroups = $userGroups;

        return $this;
    }

    /**
     * Add user group
     *
     * @param UserGroup ...$groups
     *
     * @return $this
     */
    public function addUserGroups(UserGroup ...$groups)
    {
        foreach ($groups as $group) {
            $this->getUserGroups()->add($group);
        }

        return $this;
    }

    /**
     * Remove user group
     *
     * @param UserGroup ...$groups
     *
     * @return User
     */
    public function removeUserGroups(UserGroup ...$groups)
    {
        foreach ($groups as $group) {
            $this->getUserGroups()->removeElement($group);
        }

        return $this;
    }

    /**
     * Get DefaultRoles
     *
     * @return Collection|DefaultRole[]
     */
    public function getDefaultRoles(): Collection
    {
        return $this->defaultRoles;
    }

    /**
     * Set DefaultRoles
     *
     * @param Collection|DefaultRole[] $defaultRoles
     *
     * @return $this
     */
    public function setDefaultRoles(Collection $defaultRoles)
    {
        $this->defaultRoles = $defaultRoles;

        return $this;
    }

    /**
     * Add default role.
     *
     * @param DefaultRole ...$roles
     *
     * @return $this
     */
    public function addDefaultRoles(DefaultRole ...$roles)
    {
        foreach ($roles as $role) {
            $this->getDefaultRoles()->add($role);
        }

        return $this;
    }

    /**
     * Remove default role.
     *
     * @param DefaultRole ...$roles
     *
     * @return User
     */
    public function removeDefaultRoles(DefaultRole ...$roles)
    {
        foreach ($roles as $role) {
            $this->getDefaultRoles()->removeElement($role);
        }

        return $this;
    }

    /**
     * Returns the string identifier of the Role
     *
     * @return string
     */
    public function getRoleId()
    {
        return $this->getCurrentRole();
    }

    /**
     * {@inheritdoc}
     */
    public function toArray($mapped = false)
    {
        $data = parent::toArray($mapped);

        $foreignServicesIds = [];
        $userGroups = [];

        $applicationTransformer = new ApplicationMinimalTransformer();
        $applicationGroupTransformer = new ApplicationGroupMinimalTransformer();
        $defaultRoleMinimalTransformer = new DefaultRoleMinimalTransformer();

        $serializeAttribution =
            function (Attribution $attribution) use ($applicationTransformer, $applicationGroupTransformer) {
                $item = [
                    'id' => $attribution->getId(),
                    'role' => $attribution->getRole()->toArray()
                ];

                $target = $attribution->getTarget();

                if ($target instanceof ApplicationGroup) {
                    $item['application_group'] = $applicationGroupTransformer->transform($target);
                } elseif ($target instanceof Application) {
                    $item['application'] = $applicationTransformer->transform($target);
                }

                return $item;
            };

        $attributions = $data['attributions'] instanceof Collection
            ? array_map($serializeAttribution, $data['attributions']->toArray())
            : [];

        $currentAttribution = $data['current_attribution'] ? $serializeAttribution($data['current_attribution']) : null;

        $data['foreign_services_ids'] = is_null($data['foreign_services_ids']) ? [] : $data['foreign_services_ids'];

        if (!empty($data['foreign_services_ids'])) {
            /** @var ForeignServiceId $foreignServiceId */
            foreach ($data['foreign_services_ids'] as $foreignServiceId) {
                $foreignServicesIds[] = [
                    'name' => $foreignServiceId->getName(),
                    'id' => $foreignServiceId->getId()
                ];
            }
        }

        if (!empty($data['user_groups'])) {
            /** @var UserGroup $userGroup */
            foreach ($data['user_groups'] as $userGroup) {
                $group = $userGroup->toArray();
                unset($group['users']);
                $userGroups[] = $group;
            }
        }

        $serializeDefaultRoles = function (DefaultRole $role) use ($defaultRoleMinimalTransformer) {
            return $defaultRoleMinimalTransformer->transform($role);
        };

        $data['attributions'] = $attributions;
        $data['current_attribution'] = $currentAttribution;
        $data['foreign_services_ids'] = $foreignServicesIds;
        $data['user_groups'] = $userGroups;

        return $data;
    }

    /**
     * {@inheritdoc}
     */
    public function hydrate($data)
    {
        $attributions = new ArrayCollection();
        $foreignServicesIds = new ArrayCollection();
        $userGroups = new ArrayCollection();
        $currentAttribution = null;

        if (!empty($data['attributions'])) {
            foreach ($data['attributions'] as $attribution) {
                $attributions->add(
                    (new Attribution($attribution))
                        ->setSource($this)
                );
            }
        }

        if (!empty($data['foreign_services_ids'])) {
            foreach ($data['foreign_services_ids'] as $foreignServiceId) {
                $foreignServicesIds->add(
                    (new ForeignServiceId())
                        ->setId($foreignServiceId['id'])
                        ->setName($foreignServiceId['name'])
                );
            }
        }

        if (!empty($data['current_attribution'])) {
            $currentAttribution = (new Attribution($data['current_attribution']))
                ->setSource($this);
        }

        if (!empty($data['user_groups'])) {
            foreach ($data['user_groups'] as $userGroup) {
                $group = new UserGroup($userGroup);
                $group->getUsers()->add($this);
                $userGroups->add($group);
            }
        }

        $data['foreign_services_ids'] = $foreignServicesIds;
        $data['attributions'] = $attributions;
        $data['current_attribution'] = $currentAttribution;
        $data['user_groups'] = $userGroups;

        // Since we can't hydrate the default roles back, avoid issues by setting to an empty collection.
        $data['default_roles'] = new ArrayCollection();

        return parent::hydrate($data);
    }
}

<?php

namespace duncan3dc\Sessions;

/**
 * A namespaced portion of the session data.
 */
class SessionNamespace implements SessionInterface
{
    use SessionTrait;

    /**
     * @var string $name The namespace of the session.
     */
    private $name;

    /**
     * @var SessionInterface $session The underlying session instance.
     */
    private $session;


    /**
     * Create a new namespaced portion of a session.
     *
     * @param string $name The namespace of the session
     * @param SessionInterface $session The session instance to use
     */
    public function __construct(string $name, SessionInterface $session)
    {
        $this->name = $name;
        $this->session = $session;
    }


    /**
     * Get the namespace prefix for keys.
     *
     * @return string
     */
    private function getNamespace(): string
    {
        return "_ns_{$this->name}_";
    }


    /**
     * Converts the passed session key into a namespaced key.
     *
     * @param string $key The key to convert
     *
     * @return string
     */
    private function getNamespacedKey(string $key): string
    {
        return $this->getNamespace() . $key;
    }


    /**
     * Create a new namespaced section of this session to avoid clashes.
     *
     * @param string $name The namespace of the session
     *
     * @return SessionInterface
     */
    public function createNamespace(string $name): SessionInterface
    {
        $name = $this->getNamespacedKey($name);
        return new SessionNamespace($name, $this->session);
    }


    /**
     * Get a value from the session data cache.
     *
     * @param string $key The name of the name to retrieve
     *
     * @return mixed
     */
    public function get(string $key)
    {
        $key = $this->getNamespacedKey($key);

        return $this->session->get($key);
    }


    /**
     * Get all the current session data.
     *
     * @return array
     */
    public function getAll(): array
    {
        $namespace = $this->getNamespace();
        $length = mb_strlen($namespace);

        $values = [];

        $data = $this->session->getAll();
        foreach ($data as $key => $val) {
            if (mb_substr($key, 0, $length) === $namespace) {
                $key = mb_substr($key, $length);
                $values[$key] = $val;
            }
        }

        return $values;
    }


    /**
     * Set a value within session data.
     *
     * @param string|array $data Either the name of the session key to update, or an array of keys to update
     * @param mixed $value If $data is a string then store this value in the session data
     *
     * @return SessionInterface
     */
    public function set($data, $value = null): SessionInterface
    {
        if (is_array($data)) {
            $newData = [];
            foreach ($data as $key => $val) {
                $key = $this->getNamespacedKey($key);
                $newData[$key] = $val;
            }
            $data = $newData;
        } else {
            $data = $this->getNamespacedKey($data);
        }

        $this->session->set($data, $value);

        return $this;
    }


    /**
     * Tear down the session and wipe all it's data.
     *
     * @return SessionInterface
     */
    public function clear(): SessionInterface
    {
        $values = $this->getAll();

        if (count($values) > 0) {
            $this->delete(...array_keys($values));
        }

        return $this;
    }
}

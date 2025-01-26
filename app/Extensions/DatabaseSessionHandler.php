<?php

namespace App\Extensions;

use Illuminate\Contracts\Auth\Guard;
use Illuminate\Session\DatabaseSessionHandler as BaseDatabaseSessionHandler;
use Illuminate\Database\ConnectionInterface;
use Illuminate\Contracts\Container\Container;
use Illuminate\Support\Facades\Auth;


class DatabaseSessionHandler extends BaseDatabaseSessionHandler
{
    
    protected $guards;

    /**
     * Create a new database session handler instance.
     *
     * @param  \Illuminate\Database\ConnectionInterface  $connection
     * @param  string  $table
     * @param  int  $minutes
     * @param  \Illuminate\Contracts\Container\Container|null  $container
     * @return void
     */
    public function __construct(ConnectionInterface $connection, $table, $minutes, Container $container = null)
    {
        parent::__construct($connection, $table, $minutes, $container);
        $this->guards = array_keys(config('auth.guards'));
    }

    /**
     * Add the user information to the session payload.
     *
     * @param  array  $payload
     * @return $this
     */
    protected function addUserInformation(&$payload)
    {
        if ($this->container->bound(Guard::class)) {
            $payload['user_id'] = $this->userId();
            $payload['user_type'] = $this->userType();
        }

        return $this;
    }

    /**
     * Get the currently authenticated user's ID.
     *
     * @return mixed
     */
    protected function userId()
    {
        foreach ($this->guards as $guard) {
            if (Auth::guard($guard)->check()) {
                return Auth::guard($guard)->id();
            }
        }
    }

    /**
     * Get the type of the user currently authenticated.
     *
     * @return mixed
     */
    protected function userType()
    {
        foreach ($this->guards as $guard) {
            if (Auth::guard($guard)->check()) {
                return get_class(Auth::guard($guard)->user());
            }
        }
    }


    /**
     * Get a fresh query builder instance for the table.
     *
     * @return \Illuminate\Database\Query\Builder
     */
    protected function getQuery()
    {
        if (tenancy()->initialized) {
            return $this->container->make('db')->connection('tenant')->table($this->table);
        }
        return $this->connection->table($this->table);
    }
}
<?php

namespace App\Models\Central;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Stancl\Tenancy\Database\Models\Tenant;
use Stancl\Tenancy\Contracts\TenantWithDatabase;
use Stancl\Tenancy\Database\Concerns\HasDatabase;
use Stancl\Tenancy\Database\Concerns\HasDomains;

class Clinic extends Tenant implements TenantWithDatabase
{
    use HasDatabase,
        HasDomains,
        HasFactory;

    const REFERENCE_REG_PATTERN = '/^[0-9]{6}-[0-9]{4,}$/';

    protected $connection = 'mysql';
    
    protected $fillable = [
        'name',
        'vat_number',
        'email',
        'phone',
        'location',
        'website',
        'logo',
    ];

    public static function getCustomColumns(): array
    {
        return [
            'id',
            'name',
            'vat_number',
            'email',
            'phone',
            'location',
            'website',
            'logo',
        ];
    }

    /**
     * Get the clinic's reference.
     *
     * @return string
     */
    protected function getReferenceAttribute()
    {
        $createdDate = date('ymd', strtotime($this->created_at));
        return $createdDate . '-' . sprintf('%04d', $this->id);
    }

    /**
     * Find a clinic by its reference
     * 
     * @param string $reference Reference of the clinic to search for.
     * @return \App\Models\Central\Clinic
     */
    public static function findByReference(string $reference)
    {
        $clinic = null;
        if (preg_match(static::REFERENCE_REG_PATTERN, $reference)) {
            $id = (int) explode('-', $reference)[1];
            $tenant = static::find($id);
            if ($tenant && ($tenant->reference === $reference)) $clinic = $tenant;
        }
        return $clinic;
    }

    public function getLogoUrlAttribute()
    {
        if ($this->logo) {
            return url('/storage/' . $this->logo);
        } else {
            return $this->defaultLogoUrl();
        }
    }


    public function defaultLogoUrl()
    {
        $name = $this->name ?: 'Dental Clinic CRM';
        return 'https://ui-avatars.com/api/?name=' . urlencode($name) . '&color=705EC8&background=EBF4FF';
    }

    public function hasLogo()
    {
        return !empty(static::find($this->id)->logo);
    }

    public function getIncrementing()
    {
        return true;
    }
}

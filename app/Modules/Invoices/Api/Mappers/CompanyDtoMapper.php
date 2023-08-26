<?php

declare(strict_types=1);

namespace App\Modules\Invoices\Api\Mappers;

use App\Modules\Invoices\Api\Dto\CompanyDto;
use App\Modules\Invoices\Domain\Entities\Company;

class CompanyDtoMapper
{
    public function fromEntityToDto(Company $company): CompanyDto
    {
        return new CompanyDto(
            $company->getId(),
            $company->getName(),
            $company->getStreet(),
            $company->getCity(),
            $company->getZip(),
            $company->getPhone(),
            $company->getEmail(),
            $company->getCreatedAt(),
            $company->getUpdatedAt()
        );
    }
}

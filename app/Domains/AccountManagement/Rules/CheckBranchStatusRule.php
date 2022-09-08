<?php

namespace App\Domains\AccountManagement\Rules;

use App\Domains\AccountManagement\Models\Branch;
use App\Domains\Interfaces\Rulable;

class CheckBranchStatusRule implements Rulable{

        protected Branch $branch;

        public function __construct(Branch $branch)
        {
            $this->branch = $branch;
        }

        public function run(): bool
        {
            return $this->branch->status === 1;
        }

        public function getMessage(): string
        {
            return 'Branch is offline';
        }
}

<?php

namespace SimpleNs;

use yswery\DNS\ClassEnum;
use yswery\DNS\RecordTypeEnum;
use yswery\DNS\Resolver\ResolverInterface;
use yswery\DNS\ResourceRecord;

class CustomResolver implements ResolverInterface
{
    /**
     * Return answer for given query.
     *
     * @param ResourceRecord[] $queries
     *
     * @return ResourceRecord[]
     */
    public function getAnswer(array $queries, ?string $client = null): array
    {
        $answers = [];

        foreach ($queries as $query) {
            //This is where you can put all of your logic
            if ('example.com.' === $query->getName() && 1 === $query->getType()) {
                $answer = new ResourceRecord();
                $answer->setName($query->getName());
                $answer->setClass(ClassEnum::INTERNET);
                $answer->setType(RecordTypeEnum::TYPE_A);
                $answer->setRdata('1.1.1.1');
                $answer->setTtl(3600);

                $answers[] = $answer;
            }
            if ('1.0.0.127.in-addr.arpa.' === $query->getName()) {
                $answer = new ResourceRecord();
                $answer->setName($query->getName());
                $answer->setClass(ClassEnum::INTERNET);
                $answer->setType(RecordTypeEnum::TYPE_PTR);
                $answer->setRdata('my.custom.dns.');
                $answer->setTtl(3600);

                $answers[] = $answer;
            }
        }

        return $answers;
    }

    public function allowsRecursion(): bool
    {
        return false;
    }

    public function isAuthority($domain): bool
    {
        return true;
    }

}
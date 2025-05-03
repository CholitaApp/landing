<?php declare(strict_types=1);

namespace App\Models;

trait HandleDeleteExceptions
{
    public function delete(): ?bool
    {
        try {
            return parent::delete();
        } catch (\Exception $e) {
            if ($e->getCode() == 23000) {
                $message = $e->getMessage();
                preg_match_all('/foreign key constraint fails \(`(.+?)`.`(.+?)`, CONSTRAINT `(.+?)` FOREIGN KEY \(`(.+?)`\) REFERENCES `(.+?)`/', $message, $matches);
                $related_resource = $matches[2][0];
                $resource = $matches[5][0];
                throw new \Exception(__('errors.restrict_relation_error', [
                    'resource' => $resource,
                    'related_resource' => $related_resource,
                ]), 422);
            }
            throw new \Exception(__('errors.unexpected_error'), 422);
        }
    }
}

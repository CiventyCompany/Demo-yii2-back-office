<?php
namespace backend\helpers\traits;

trait ArchiveActiveRecord
{
    public static function getDb()
    {
        return 'dbArchive';
    }
}
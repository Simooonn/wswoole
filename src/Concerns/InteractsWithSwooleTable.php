<?php

namespace HashyooSwoole\Concerns;

use Illuminate\Contracts\Console\Application as ConsoleApp;
use Swoole\Table;
use HashyooSwoole\Table\SwooleTable;

/**
 * Trait InteractsWithSwooleTable
 *
 * @property \Illuminate\Contracts\Container\Container $container
 * @property \Illuminate\Contracts\Container\Container $app
 */
trait InteractsWithSwooleTable
{
    /**
     * @var \HashyooSwoole\Table\SwooleTable
     */
    protected $currentTable;

    /**
     * Register customized swoole talbes.
     * 注册定制swoole talbes。
     */
    protected function createTables()
    {
        $this->currentTable = new SwooleTable;
//        $this->registerTables();
    }

    /**
     * Register user-defined swoole tables.
     */
    protected function registerTables()
    {
        $tables = wswoole_tables();

        foreach ($tables as $key => $value) {
            $table = new Table($value['size']);
            $columns = $value['columns'] ?? [];
            foreach ($columns as $column) {
                switch ($column['type'])
                {
                    case 'int':
                        $column['type'] = Table::TYPE_INT;
                        break;
                    case 'float':
                        $column['type'] = Table::TYPE_FLOAT;
                        break;
                    case 'string':
                        $column['type'] = Table::TYPE_STRING;
                        break;
                    default:
                        $column['type'] = Table::TYPE_STRING;
                }
                if (isset($column['size'])) {
                    $table->column($column['name'], $column['type'], $column['size']);
                } else {
                    $table->column($column['name'], $column['type']);
                }
            }
            $table->create();

            $this->currentTable->add($key, $table);
        }
    }

    /**
     * Bind swoole table to Laravel app container.
     */
    protected function bindSwooleTable()
    {
        if (! $this->app instanceof ConsoleApp) {
            $this->app->singleton(SwooleTable::class, function () {
                return $this->currentTable;
            });

            $this->app->alias(SwooleTable::class, 'swoole.table');
        }
    }
}

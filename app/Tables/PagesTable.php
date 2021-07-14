<?php

namespace App\Tables;

use App\Models\Page;
use Okipa\LaravelTable\Abstracts\AbstractTable;
use Okipa\LaravelTable\Table;

class PagesTable extends AbstractTable
{
    /**w
     * Configure the table itself.
     *
     * @return \Okipa\LaravelTable\Table
     * @throws \ErrorException
     */
    protected function table(): Table
    {
        return (new Table())->model(Page::class)
            ->routes([
                'index'   => ['name' => 'admin.pages.index'],
                'create'  => ['name' => 'admin.pages.create'],
                'edit'    => ['name' => 'admin.pages.edit'],
                'destroy' => ['name' => 'admin.pages.destroy'],
            ])
            ->destroyConfirmationHtmlAttributes(fn(Page $page) => [
                'data-confirm' => __('Are you sure you want to delete the entry :entry?', [
                    'entry' => $page->database_attribute,
                ]),
            ]);
    }

    /**
     * Configure the table columns.
     *
     * @param \Okipa\LaravelTable\Table $table
     *
     * @throws \ErrorException
     */
    protected function columns(Table $table): void
    {
        $table->column('id')->title("#")->sortable();
        $table->column('title')->title("Название")->sortable();
        $table->column('slug')->title("Короткая ссылка")->sortable();
        $table->column('updated_at')->title("Последнее обновление")->dateTimeFormat('d/m/Y H:i')->sortable(true, 'desc');
    }

    /**
     * Configure the table result lines.
     *
     * @param \Okipa\LaravelTable\Table $table
     */
    protected function resultLines(Table $table): void
    {
        //
    }
}

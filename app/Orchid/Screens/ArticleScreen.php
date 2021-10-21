<?php

namespace App\Orchid\Screens;

use Orchid\Screen\Screen;
use Orchid\Screen\Actions\DropDown;
use Orchid\Screen\Actions\Button;
use Orchid\Screen\Repository;
use Orchid\Support\Facades\Layout;
use Orchid\Screen\TD;
use Illuminate\Support\Str;




class ArticleScreen extends Screen
{

    /**
     * Fish text for the table.
     */
    public const TEXT_EXAMPLE = 'Lorem ipsum at sed ad fusce faucibus primis, potenti inceptos ad taciti nisi tristique
    urna etiam, primis ut lacus habitasse malesuada ut. Lectus aptent malesuada mattis ut etiam fusce nec sed viverra,
    semper mattis viverra malesuada quam metus vulputate torquent magna, lobortis nec nostra nibh sollicitudin
    erat in luctus.';


    /**
     * Display header name.
     *
     * @var string
     */
    public $name = 'Articles List';

    /**
     * Display header description.
     *
     * @var string
     */
    public $description = 'Article Screen Components';

    /**
     * Query data.
     *
     * @return array
     */
    public function query(): array
    {
        return [

            'table'   => [
                new Repository(['id' => 100, 'name' => self::TEXT_EXAMPLE, 'price' => 10.24, 'created_at' => '01.01.2020']),
                new Repository(['id' => 200, 'name' => self::TEXT_EXAMPLE, 'price' => 65.9, 'created_at' => '01.01.2020']),
                new Repository(['id' => 300, 'name' => self::TEXT_EXAMPLE, 'price' => 754.2, 'created_at' => '01.01.2020']),
                new Repository(['id' => 400, 'name' => self::TEXT_EXAMPLE, 'price' => 0.1, 'created_at' => '01.01.2020']),
                new Repository(['id' => 500, 'name' => self::TEXT_EXAMPLE, 'price' => 0.15, 'created_at' => '01.01.2020']),

            ],
        ];
    }

    /**
     * Button commands.
     *
     * @return \Orchid\Screen\Action[]
     */
    public function commandBar(): array
    {
        return [

            DropDown::make('Dropdown button')
                ->icon('folder-alt')
                ->list([

                    Button::make('Action')
                        ->method('showToast')
                        ->icon('bag'),

                    Button::make('Another action')
                        ->method('showToast')
                        ->icon('bubbles'),

                    Button::make('Something else here')
                        ->method('showToast')
                        ->icon('bulb'),
                    ]),
        ];
    }

    /**
     * Views.
     *
     * @return \Orchid\Screen\Layout[]|string[]
     */
    public function layout(): array
    {
        return [

            Layout::table('table', [
                TD::make('id', 'ID')
                    ->width('150')
                    ->render(function (Repository $model) {
                        // Please use view('path')
                        return "<img src='https://picsum.photos/450/200?random={$model->get('id')}'
                              alt='sample'
                              class='mw-100 d-block img-fluid'>
                            <span class='small text-muted mt-1 mb-0'># {$model->get('id')}</span>";
                    }),

                TD::make('name', 'Name')
                    ->width('450')
                    ->render(function (Repository $model) {
                        return Str::limit($model->get('name'), 200);
                    }),

                TD::make('price', 'Price')
                    ->render(function (Repository $model) {
                        return '$ '.number_format($model->get('price'), 2);
                    }),

                TD::make('created_at', 'Created'),
            ]),

            
        ];
    }
}

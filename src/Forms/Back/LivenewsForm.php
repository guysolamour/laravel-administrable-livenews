<?php

namespace Guysolamour\Administrable\Extensions\Livenews\Forms\Back;

use Illuminate\Support\Facades\Lang;
use Kris\LaravelFormBuilder\Form;

class LivenewsForm extends Form
{
    public function buildForm()
    {
        if ($this->getModel() && $this->getModel()->getKey()) {
            $method = 'PUT';
            $url    = back_route('extensions.livenews.livenews.update', $this->getModel());
        } else {
            $method = 'POST';
            $url    = back_route('extensions.livenews.livenews.store');
        }

        $this->formOptions = [
            'method' => $method,
            'url'    => $url,
            'name'   => get_form_name($this->getModel()),
        ];

        $this
            // add fields here
            ->add('text_color', 'color', [
                'label' => Lang::get('administrable-livenews::translations.view.text_color'),
                'rules' => ['required', 'string',],
            ])
            ->add('background_color', 'color', [
                'label'  => Lang::get('administrable-livenews::translations.view.back_color'),
                'rules' => ['required', 'string',],
            ])
            ->add('size', 'number', [
                'label'  => Lang::get('administrable-livenews::translations.view.size'),
                'rules' => ['required', 'integer',],
            ])
            ->add('started_at', 'text', [
                'label'  => Lang::get('administrable-livenews::translations.view.started_at'),
                'rules' => ['required', 'string',],
            ])
            ->add('ended_at', 'text', [
                'label'  => Lang::get('administrable-livenews::translations.view.ended_at'),
                'rules' => ['required', 'string',],
            ])
            ->add('content', 'textarea', [
                'label'  => Lang::get('administrable-livenews::translations.view.content'),
                'rules' => ['required', 'string',],
            ])
            ->add('uppercase', 'select', [
                'choices' => ['1' => Lang::get('administrable::messages.default.yes'), '0' => Lang::get('administrable::messages.default.no')],
                'rules' => 'required',
                'label'  => Lang::get('administrable-livenews::translations.view.uppercase'),
                'attr'  => [
                    'class' => 'form-control select2'
                ]
            ])
            ->add('online', 'select', [
                'choices' => ['1' => Lang::get('administrable::messages.default.yes'), '0' => Lang::get('administrable::messages.default.no')],
                'rules' => 'required',
                'label'  => Lang::get('administrable-livenews::translations.view.online'),
                'attr'  => [
                    'class' => 'form-control select2'
                ]
            ]);
    }
}

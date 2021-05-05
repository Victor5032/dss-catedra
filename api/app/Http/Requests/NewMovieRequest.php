<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class NewMovieRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'title' => [
                'required'
            ],
            'poster' => [
                'required'
            ],
            'description' => [
                'required'
            ],
            'rent_price' => [
                'required', 'numeric', 'between:1.00,16.00'
            ],
            'sale_price' => [
                'required', 'numeric', 'between:1.00,16.00'
            ],
            'stock' => [
                'required', 'integer', 'min:0', 'digits_between:0,50'
            ],
        ];
    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'title.required' => 'Titulo requerido es requerido',
            'poster.required' => 'Poster de la pelicula requerido',
            'description.required' => 'Descripción de la pelicula requerido',
            'rent_price.required' => 'Precio de alquiler requerido',
            'rent_price.numeric' => 'El dato ingresado no es de tipo numerico',
            'rent_price.between' => 'El precio de alquiler debe de estar en el rango de $1 hasta $16',
            'sale_price.required' => 'Precio de venta requerido',
            'sale_price.numeric' => 'El dato ingresado no es de tipo numerico',
            'sale_price.between' => 'El precio de venta debe de estar en el rango de $1 hasta $16',
            'stock.required' => 'Es requerido el numero de unidades disponibles',
            'stock.digits_between' => 'El numero de unidades disponibles esta fuera de lo permitido',
        ];
    }
}

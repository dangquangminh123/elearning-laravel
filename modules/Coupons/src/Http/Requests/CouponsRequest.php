<?php

namespace Modules\Coupons\src\Http\Requests;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Validator;
use Carbon\Carbon;

class CouponsRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        $id = $this->route()->course;
        $uniqueRule = 'unique:courses,code';

        if($id) {
            $uniqueRule.=','.$id;
        }

        $rules = [
            'code' => 'required|string|max:100|unique:coupons,code,' . $this->route('coupon'),
            'discount_type' => 'required|string|max:255',
            'discount_value' => 'required|numeric|min:0',
            'total_condition' => 'required|numeric|min:0',
            'count' => 'required|integer|min:1',
            'start_date' => 'required|date|before_or_equal:end_date',
            'end_date' => 'required|date|after_or_equal:start_date',
        ];

        return $rules;
    }

    public function withValidator(Validator $validator): void
    {
        $validator->after(function ($validator) {
            $discountType = $this->input('discount_type');
            $discountValue = (int) $this->input('discount_value');
            $totalCondition = (int) $this->input('total_condition');
            $startDate = $this->input('start_date');
            $endDate = $this->input('end_date');

            if ($startDate && $endDate) {
                $start = Carbon::parse($startDate);
                $end = Carbon::parse($endDate);
                if ($end->diffInDays($start, false) < 2) {
                    $validator->errors()->add('end_date', __('coupons::messages.end_date_too_close'));
                }
            }

            if ($discountType === 'percent') {
                if ($discountValue < 0 || $discountValue > 30) {
                    $validator->errors()->add('discount_value', __('coupons::messages.percent_range_invalid'));
                }

                if ($discountValue >= 0 && $discountValue <= 5 && $totalCondition >= 200000) {
                    $validator->errors()->add('total_condition', __('coupons::messages.percent_0_5_invalid'));
                } elseif ($discountValue > 5 && $discountValue <= 10 && ($totalCondition < 200000 || $totalCondition > 499000)) {
                    $validator->errors()->add('total_condition', __('coupons::messages.percent_6_10_invalid'));
                } elseif ($discountValue > 10 && $discountValue <= 12 && ($totalCondition < 500000 || $totalCondition > 999000)) {
                    $validator->errors()->add('total_condition', __('coupons::messages.percent_11_12_invalid'));
                } elseif ($discountValue > 12 && $discountValue <= 15 && ($totalCondition < 1000000 || $totalCondition > 1999000)) {
                    $validator->errors()->add('total_condition', __('coupons::messages.percent_13_15_invalid'));
                } elseif ($discountValue > 15 && $discountValue <= 20 && ($totalCondition < 2000000 || $totalCondition > 4999000)) {
                    $validator->errors()->add('total_condition', __('coupons::messages.percent_16_20_invalid'));
                } elseif ($discountValue > 20 && $discountValue <= 30 && $totalCondition <= 5000000) {
                    $validator->errors()->add('total_condition', __('coupons::messages.percent_21_30_invalid'));
                }
            }

            if ($discountType === 'value') {
                if ($discountValue >= 90000 && $discountValue <= 150000 && $totalCondition >= 800000) {
                    $validator->errors()->add('total_condition', __('coupons::messages.value_90_150_invalid'));
                } elseif ($discountValue >= 160000 && $discountValue <= 360000 && ($totalCondition < 800000 || $totalCondition > 1400000)) {
                    $validator->errors()->add('total_condition', __('coupons::messages.value_160_360_invalid'));
                } elseif ($discountValue >= 370000 && $discountValue <= 500000 && ($totalCondition < 1499000 || $totalCondition > 1999000)) {
                    $validator->errors()->add('total_condition', __('coupons::messages.value_370_500_invalid'));
                } elseif ($discountValue >= 500000 && $discountValue <= 699000 && ($totalCondition < 2000000 || $totalCondition > 2999000)) {
                    $validator->errors()->add('total_condition', __('coupons::messages.value_500_699_invalid'));
                } elseif ($discountValue == 799000 && $totalCondition <= 3000000) {
                    $validator->errors()->add('total_condition', __('coupons::messages.value_799_invalid'));
                }
            }
        });
    }
   public function messages(): array
    {
        return [
            'code.unique' => __('coupons::validation.unique', ['attribute' => __('coupons::validation.attributes.code')]),
            'discount_value.required' => __('coupons::validation.required', ['attribute' => __('coupons::validation.attributes.discount_value')]),
            'total_condition.required' => __('coupons::validation.required', ['attribute' => __('coupons::validation.attributes.total_condition')]),
            'start_date.required' => __('coupons::validation.required', ['attribute' => __('coupons::validation.attributes.start_date')]),
            'end_date.required' => __('coupons::validation.required', ['attribute' => __('coupons::validation.attributes.end_date')]),
        ];
    }

    public function attributes(): array
    {
        return __('coupons::validation.attributes');
    }

}
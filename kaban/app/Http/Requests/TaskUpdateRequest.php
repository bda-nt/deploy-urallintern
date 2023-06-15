<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TaskUpdateRequest extends FormRequest
{

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */

    public function authorize(): bool
    {
        $this->merge([
            'taskId' => $this->route('taskId'),
        ]);

        if (isset($this->task_name)) {
            $this->merge([
                'name' => $this->task_name,
            ]);
        }

        $this->valid = $this->validate([ // изменение request
            'taskId' => [
                'numeric'
            ],
            'parent_id' => [
                'numeric'
            ],
            'project_id' => [
                'numeric'
            ],
            'team_id' => [
                'numeric'
            ],
            'name' => [
                'string'
            ],
            'is_on_kanban' => [
                'boolean'
            ],
            'is_completed' => [
                'boolean'
            ],
            'status_id' => [
                'numeric'
            ],
            'planned_start_date' => [
                'date'
            ],
            'planned_final_date' => [
                'date'
            ],
            'deadline' => [
                'date'
            ],
            'completed_at' => [
                'date'
            ],
            'description' => [
                'string'
            ],

            'stages' => [
                'array',
                'min:1',
            ],
            'stages.*' => [
                'array',
                'min:1',
            ],
            'stages.*.description' => [
                'string',
                'max:128',
                'min:3',
            ],
            'stages.*.is_ready' => [
                'boolean' // true, false, 1, 0, "1", and "0"
            ],
            'stages.*.id' => [
                'numeric'
            ],

            'responsible_time_spent' => [
                ''
            ],
            'responsible_id' => [
                'numeric'
            ]
        ]);

        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function rules(): array
    {
        return [
            //
        ];
    }
}

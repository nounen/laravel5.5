<?php

namespace App\Models;

/**
 * Class Tag
 * @package App\Models
 */
class Form extends BaseModel
{
    protected $table = 'form';

    protected $fillable = [
        '*',
    ];

    /**
     * 所有字段
     *
     * @return array
     */
    public static function getFields()
    {
        return [
            'id'       => [
                'name'   => '主键',
                'create' => false,
            ],
            'test'     => [
                'name'       => '测试',
                // 元素
                'element'    => 'input',
//                // 三个特殊属性 (好像不必要, 根据 element 和 具体是 create / update 来决定)
//                'id'      => 'key',
//                'name'    => 'key', // 'key[]'
//                'value'   => 'key',
                // 优先级低
//                    'options' => [
//                        [
//                            'value' => 3,
//                            'name'  => '其它',
//                        ],
//                    ],
//                'create'  => [
                // 属性
                'attributes' => [
                    'type'        => 'text',
                    'placeholder' => 'placeholder',
                    'required'    => 'required',
                    'checked'     => 'checked',
                    'selected'    => 'selected',
                    'readonly'    => 'readonly',
                    'disabled'    => 'disabled',
                    'size'        => 5,
                    'maxlength'   => 10,
                    'multiple'    => 'multiple',
                    'pattern'     => '\d{11}',
                    // 优先级高
//                    'options' => [
//                        [
//                            'value' => 3,
//                            'name'  => '其它',
//                        ],
//                    ],
                ],
//                ],
            ],
            'text'     => [
                'name'       => '文本',
                'element'    => 'input',
                'create'     => true,
                'attributes' => [
                    'type'        => 'text',
                    'placeholder' => '请输入 text',
                    'maxlength'   => 5,
                ],
            ],
            'file'     => [
                'name'       => '文件',
                'element'    => 'input',
                'create'     => true,
                'attributes' => [
                    'type' => 'file',
                    'required' => 'required',
                ],
            ],
            'radio'    => [
                'name'       => '单选',
                'element'    => 'radio',
                'create'     => true,
                'attributes' => [
                    'type'        => 'radio',
                    'placeholder' => '请选择 radio',
                ],
                'options'    => [
                    [
                        'value' => 1,
                        'name'  => '男',
                    ],
                    [
                        'value' => 2,
                        'name'  => '女',
                    ],
                ],
            ],
            'checkbox' => [
                'name'       => '复选',
                'element'    => 'checkbox',
                'create'     => true,
                'attributes' => [
                    'type'        => 'checkbox',
                    'placeholder' => '请选择 checkbox',
                ],
                'options'    => [
                    [
                        'value' => 1,
                        'name'  => '语文',
                    ],
                    [
                        'value' => 2,
                        'name'  => '数学',
                    ],
                    [
                        'value' => 3,
                        'name'  => '英语',
                    ],
                ],
            ],
            'select'   => [
                'name'       => '下拉选',
                'element'    => 'select',
                'create'     => true,
                'attributes' => [
                    'type'     => 'select',
                    'required' => 'required',
//                        'multiple'    => 'multiple',
                ],
                'options'    => [
                    [
                        'value' => 1,
                        'name'  => '一级',
                    ],
                    [
                        'value' => 2,
                        'name'  => '二级',
                    ],
                    [
                        'value' => 3,
                        'name'  => '三级',
                    ],
                ],
            ],
            'textarea' => [
                'name'       => '文本框',
                'element'    => 'textarea',
                'create'     => true,
                'attributes' => [
                    'type'        => 'textarea',
                    'placeholder' => '请输入 textarea',
                    'maxlength'   => 5,
                ],
            ],
            'slot' => [
                'name'       => '自定义元素',
                'element'    => 'slot',
                'create'     => true,
                'attributes' => [],
            ],
        ];
    }

    /**
     * 创建页面字段
     *
     * @return array
     */
    public static function getCreateRows()
    {
        $rows = [];

        $fields = self::getFields();

        foreach($fields as $fieldKey => $field) {
            if (isset($field['create']) && $field['create']) {
                // 表单元素通用属性
                $row = [
                    'key'       => $fieldKey,
                    'name'      => $field['name'],
                    'element'   => array_get($field, 'element'),
                    'attribute' => null,
                    'options'   => array_get($field, 'create.options', array_get($field, 'options')), // 优先 create
                ];

                // HTML 属性拼接
                $attrs = array_get($field, 'attributes', array_get($field, 'create.attributes', []));

                foreach ($attrs as $attrKey => $attr) {
                    $row['attribute'] .= " {$attrKey}=\"{$attr}\"";
                }

                $rows[] = $row;
            } else {
                continue;
            }
        }

        return $rows;
    }
}

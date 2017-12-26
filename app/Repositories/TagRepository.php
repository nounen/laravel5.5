<?php

namespace App\Repositories;

use App\Models\Tag;

/**
 * Class TagRepository
 * @package App\Repositories
 */
class TagRepository extends BaseRepository
{
    /**
     * 分页数据
     */
    public function paginate($user)
    {
        $fieldMaps = [];

        $tags = $this->search(Tag::class, $fieldMaps)
                    ->where('user_id', $user->id)
                    ->paginate();

        return $tags;
    }

    /**
     * 创建标签
     *
     * TODO: 如何封装通过 store 放到 BaseRepository, 且包含异常处理
     *
     * @param $input
     */
    public function store($input)
    {
        Tag::create($input);
    }

    /**
     * 标签详情
     *
     * @param $id
     * @param $user
     * @return mixed
     */
    public function show($id, $user)
    {
        return Tag::where('user_id', $user->id)->find($id);
    }

    /**
     * 更新标签
     *
     * @param $id
     * @param $input
     * @param $user
     */
    public function update($id, $input, $user)
    {
        $tag = Tag::where('user_id', $user->id)->find($id);

        if ($tag) {
            $tag->update($input);
        }
    }

    /**
     * 删除标签
     *
     * @param $id
     * @param $user
     */
    public function destroy($id, $user)
    {
        $tag = Tag::where('user_id', $user->id)->find($id);

        if ($tag) {
            $tag->delete($id);
        }
    }
}

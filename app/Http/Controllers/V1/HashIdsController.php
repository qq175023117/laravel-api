<?php

namespace App\Http\Controllers\V1;


use Illuminate\Http\Request;
use Vinkla\Hashids\Facades\Hashids;

/**
 * Class HashIdsController
 * @author WXiangQian <175023117@qq.com>
 * @package App\Http\Controllers\V1
 */
class HashIdsController extends BaseController
{

    /**
     * @SWG\Post(
     *      path="/hash_ids/encode",
     *      tags={"public"},
     *      operationId="hash_ids_encode",
     *      summary="hashids加密",
     *      consumes={"application/json"},
     *      produces={"application/json"},
     *     @SWG\Parameter(
     *          in="body",
     *          name="data",
     *          description="",
     *          required=true,
     *          @SWG\Schema(
     *              type="object",
     *              @SWG\Property(property="id",description="要加密的id",type="integer"),
     *          )
     *      ),
     *      @SWG\Response(
     *          response=200,
     *          description="",
     *          @SWG\Schema(
     *              type="object",
     *              @SWG\Property(property="code", type="string",description="状态码"),
     *              @SWG\Property(property="message", type="string",description="提示信息"),
     *              @SWG\Property(property="data", type="string",description="加密后的id"),
     *          )
     *      ),
     * )
     */
    public function hashIdsEncode(Request $request)
    {
        $this->validate($request, [
            'id' => 'required|integer',
        ]);

        $id = $request->input('id', '');

        $hashId = Hashids::encode($id);

        return $this->responseData($hashId);
    }

    /**
     * @SWG\Post(
     *      path="/hash_ids/decode",
     *      tags={"public"},
     *      operationId="hash_ids_decode",
     *      summary="hashids解密",
     *      consumes={"application/json"},
     *      produces={"application/json"},
     *     @SWG\Parameter(
     *          in="body",
     *          name="data",
     *          description="",
     *          required=true,
     *          @SWG\Schema(
     *              type="object",
     *              @SWG\Property(property="hash_id",description="要解密的id",type="string"),
     *          )
     *      ),
     *      @SWG\Response(
     *          response=200,
     *          description="",
     *          @SWG\Schema(
     *              type="object",
     *              @SWG\Property(property="code", type="string",description="状态码"),
     *              @SWG\Property(property="message", type="string",description="提示信息"),
     *              @SWG\Property(property="data", type="string",description="解密后的id"),
     *          )
     *      ),
     * )
     */
    public function hashIdsDecode(Request $request)
    {
        $this->validate($request, [
            'hash_id' => 'required',
        ]);
        $hashId = $request->input('hash_id');

        $id = Hashids::decode($hashId);
        if (isset($id[0])) {
            return $this->responseData($id[0]);
        }
    }

}
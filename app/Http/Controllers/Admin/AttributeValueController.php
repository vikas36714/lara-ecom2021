<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\AttributeValue;
use App\Contracts\AttributeContract;

class AttributeValueController extends Controller
{
    protected $attributeRepositery;

    public function __construct(AttributeContract $attributeRepositery)
    {
        $this->attributeRepositery = $attributeRepositery;
    }

    public function getValues(Request $request)
    {
        $attributeId = $request->id;

        $attribute = $this->attributeRepositery->findAttributeById($attributeId);

        $values =  $attribute->values;

        return response()->json($values);
    }

    public function addValues(Request $request)
    {
        $value = new AttributeValue();
        $value->attribute_id = $request->input('id');
        $value->value = $request->input('value');
        $value->price = $request->input('price');
        $value->save();

        return response()->json($value);
    }

    public function updateValues(Request $request)
    {
        $attributeValue = AttributeValue::findOrFail($request->input('valueId'));
        $attributeValue->attribute_id = $request->input('id');
        $attributeValue->value = $request->input('value');
        $attributeValue->price = $request->input('price');
        $attributeValue->save();

        return response()->json($attributeValue);
    }

    public function deleteValues(Request $request)
    {
        $attributeValue = AttributeValue::findOrFail($request->input('id'));
        $attributeValue->delete();

        return response()->json(['status' => 'success', 'message' => 'Attribute value deleted successfully.']);
    }

}
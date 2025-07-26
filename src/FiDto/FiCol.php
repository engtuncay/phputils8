<?php

namespace Engtuncay\Phputils8\FiDto;

/**
 *
 */
class FiCol
{
  /**
   * Alanın ismini (veritabanındaki veya objedeki refere ettiği alan ismi )
   */
  public ?string $ofcTxFieldName = null;

  /**
   * Alanın başlık açıklaması ( tablo için sütün başlığı , form için label alanı değeri / excelde başlık )
   */
  public ?string $ofcTxHeader = null;

  public ?string $txLabel = null;

  /**
   * Objedeki alan adı (fieldName) ile db deki alan adı aynı degilse kullanılır.
   */
  public ?string $ofcTxDbFieldName = null;

  /**
   * Col Id olması için konuldu - tekil kodu
   *
   * Experimental durumda şu an
   */
  public ?string $txGuid = null;

    // FiId
  public ?string $ofcTxIdType = null;
  // FiColumn
  public ?bool $ofcBoUniqGro1 = null;
  public ?bool $ofcBoNullable = null;
  public ?bool $ofcBoUnique = null;

  //public ?bool $ofcBoUtfSupport = null;
  public ?string $ofcTxDefValue = null;
  public ?string $ofcTxCollation = null;
  public ?string $ofcTxTypeName = null;
  public ?int $ofcLnLength = null;

  /**
   * @var int|null
   */
  public ?int $ofcLnPrecision = null;
  public ?int $ofcLnScale = null;
  public ?bool $ofcBoFilterLike = null;

  public ?string $ofcTxFieldType = null;

  //FiTransient

  public ?string $ofcTxEntityName = null;


  /**
   * alanın veritabanında olmadığını belirtir
   */
  public ?bool $ofcBoTransient = null;

  //public ObjectProperty<Double> prefSize;

  //public ?integer printSize;

  // Alanın türünü belirtir (double,?string,date vs )
  public ?string $colType = null; //OzColType

  //public OzColType colGenType;

  // Formlarda default true olarak çalışır, false olursa düzenleme izni vermez
  /**
   * Column Generic Type. Sütun nasıl bir tipte olduğunu gösterir. (Data Tipi degil)
   * <p>
   * Örneğin , Xml parse edilirken, alanın xmlAttribute türünde olduğunu gösterir.
   */
  public ?bool $boEditable = null;

  // URFIX !!! ofc başlamayan alanlar kaldırılacak
  /**
   * Formlarda gösterilmeyeceğini belirtir
   */
  public ?bool $boHidden = null;

  // excelden sütunları ayarlarken opsiyonel sütunların belinmesi için (zorunlu degil)
  // vs.. (boRequired:false da kullanılabilirdi.)
  public ?bool $boOptional;

  // excelde sütunun bulunduğunu gösterir
  public ?bool $boExist = null;

  // Excel için true olursa sütunun olması gerektiğini gösterir
  public ?bool $boRequired = null;

  // For Excel Reading, the field shows whether or not column exists in the excel
  public ?bool $boEnabled = null;

  // Reflection Field Alanlar



  //public ?string $ficTxSqlFieldDefinition;

  /**
   * @param string|null $ofcTxFieldName
   * @param string|null $ofcTxHeader
   */
  public function __construct(?string $ofcTxFieldName = null, ?string $ofcTxHeader = null)
  {
    $this->ofcTxFieldName = $ofcTxFieldName;
    $this->ofcTxHeader = $ofcTxHeader;
  }

  public function buiColType(string $string): FiCol
  {
    $this->colType = $string;
    return $this;
  }

  public function __toString(): string
  {
    return $this->ofcTxFieldName;
  }

  public function getOfcTxFieldNameNtn(): string
  {
    if ($this->ofcTxFieldName == null) return "";
    return $this->ofcTxFieldName;
  }

  public function getOfcTxEntityNameNtn(): string
  {
    if ($this->ofcTxEntityName == null) {
      return "bosentity";
    }
    return $this->ofcTxEntityName;
  }


}
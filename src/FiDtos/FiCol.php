<?php

namespace Engtuncay\Phputils8\FiDtos;

/**
 *
 */
class FiCol
{
  /**
   * Alanın ismini (veritabanındaki veya objedeki refere ettiği alan ismi )
   */
  public ?string $fcTxFieldName = null;

  /**
   * Alanın başlık açıklaması ( tablo için sütün başlığı , form için label alanı değeri / excelde başlık )
   */
  public ?string $fcTxHeader = null;

  public ?string $txLabel = null;

  /**
   * Objedeki alan adı (fieldName) ile db deki alan adı aynı degilse kullanılır.
   */
  public ?string $fcTxDbFieldName = null;

  /**
   * Col Id olması için konuldu - tekil kodu
   *
   * Experimental durumda şu an
   */
  public ?string $txGuid = null;

    // FiId
  public ?string $fcTxIdType = null;
  // FiColumn
  public ?bool $fcBoUniqGro1 = null;
  public ?bool $fcBoNullable = null;
  public ?bool $fcBoUnique = null;

  //public ?bool $fcBoUtfSupport = null;
  public ?string $fcTxDefValue = null;
  public ?string $fcTxCollation = null;
  public ?string $fcTxTypeName = null;
  public ?int $fcLnLength = null;

  /**
   * @var int|null
   */
  public ?int $fcLnPrecision = null;
  public ?int $fcLnScale = null;
  public ?bool $fcBoFilterLike = null;

  public ?string $fcTxFieldType = null;

  //FiTransient

  public ?string $fcTxEntityName = null;


  /**
   * alanın veritabanında olmadığını belirtir
   */
  public ?bool $fcBoTransient = null;

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

  // URFIX !!! fc başlamayan alanlar kaldırılacak
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
   * @param string|null $fcTxFieldName
   * @param string|null $fcTxHeader
   */
  public function __construct(?string $fcTxFieldName = null, ?string $fcTxHeader = null)
  {
    $this->fcTxFieldName = $fcTxFieldName;
    $this->fcTxHeader = $fcTxHeader;
  }

  public function buiColType(string $string): FiCol
  {
    $this->colType = $string;
    return $this;
  }

  public function __toString(): string
  {
    return $this->fcTxFieldName;
  }

  public function getFcTxFieldNameNtn(): string
  {
    if ($this->fcTxFieldName == null) return "";
    return $this->fcTxFieldName;
  }

  public function getFcTxEntityNameNtn(): string
  {
    if ($this->fcTxEntityName == null) {
      return "bosentity";
    }
    return $this->fcTxEntityName;
  }


}
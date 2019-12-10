<script type="application/ld+json">
    {
      "@context" : "https://schema.org",
      "@type" : "Organization",
      "name" : "<?=$row_setting['ten_'.$lang]?>",
      "url" : "<?=$http.$config_url?>",
      "address": {
        "@type": "PostalAddress",
        "streetAddress": "<?=$row_setting['diachi_'.$lang]?>",
        "addressRegion": "Ho Chi Minh",
        "postalCode": "70000",
        "addressCountry": "vi"
      }
    }
</script>
<?php if($template=='product_detail') {?>
<!-- <script type="application/ld+json">
    {
      "@context": "https://schema.org/",
      "@type": "Product",
      "name": "<?=$row_detail['ten_'.$lang]?>",
      "image": [
        "<?=$http.$config_url?>/<?=_upload_product_l.$row_detail['photo']?>"
        ],
      "description": "<?=$description_bar?>",
      "sku":"SP<?=$row_detail['id']?>",
      "mpn": "925872",
      "brand": {
        "@type": "Thing",
        "name": "ACME"
      },
      "review": {
        "@type": "Review",
        "reviewRating": {
          "@type": "Rating",
          "ratingValue": "<?=$row_detail['rate'] > 0 ? $row_detail['rate'] : 5?>",
          "bestRating": "5"
        },"author": {
          "@type": "Person",
          "name": "<?=$row_setting['ten_'.$lang]?>"
        }
      },
      "aggregateRating": {
        "@type": "AggregateRating",
        "ratingValue": "4.4",
        "reviewCount": "89"
      },

      "offers": {
        "@type": "Offer",
        "url":"<?=getCurrentPageURL_CANO()?>",
        "priceCurrency": "VND",
        "price": "<?=$row_detail['giaban']?>",
        "priceValidUntil": "2020-11-05",
        "itemCondition": "https://schema.org/UsedCondition",
        "availability": "https://schema.org/InStock",
        "seller": {
          "@type": "Organization",
          "name": "Executive Objects"
        }
      }
    }
</script> -->
<?php } ?>
<?php if($template=='news_detail' || $template=='dichvu_detail'){?>
    <script type="application/ld+json">
    {
      "@context": "https://schema.org",
      "@type": "NewsArticle",
      "mainEntityOfPage": {
        "@type": "WebPage",
        "@id": "https://google.com/article"
      },
      "headline": "<?=$row_detail['ten_vi']?>",
      "image": [
        "<?=$http.$config_url?>/<?=_upload_baiviet_l.$row_detail['photo']?>"
        ],
      "datePublished": "<?=date('Y-m-d',$row_detail['ngaytao'])?>",
      "dateModified": "<?=date('Y-m-d',$row_detail['ngaytao'])?>",
      "author": {
        "@type": "Person",
        "name": "Etoy"
      },
       "publisher": {
        "@type": "Organization",
        "name": "Google",
        "logo": {
          "@type": "ImageObject",
          "url": "<?=$http.$config_url?>/<?=_upload_hinhanh_l.$logo['photo_'.$lang]?>"
        }
      },
      "description": "<?=$description_bar?>"
    }
    </script>

<?php }?>
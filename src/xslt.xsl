<?xml version="1.0" encoding="UTF-8" ?>
<xsl:stylesheet version="1.0" xmlns:xsl="http://www.w3.org/1999/XSL/Transform">
    <xsl:key name="Book-by-Author" match="book" use="author"/>
    <xsl:param name="sortColumnField" select="//catalog/@sortby"/>
    <xsl:param name="sortColumnDataType" select="//catalog/@sortdatatype"/>
    <xsl:template match="/">
        <html>
            <head>
                <title>Library</title>
                <!--<link rel="stylesheet" href="lib.css">-->
            </head>
            <body>
                <!--<form name="searchForm" action="" method="get">-->
                    <!--<xsl:-->
                    <!--<input name="title" type="text" placeholder="Title" />-->
                    <!--<input name="minPrice"-->
                           <!--type="number"-->
                           <!--step="0.05"-->
                           <!--value="{//catalog/@minprice}"-->
                           <!--min="{//catalog/@minprice}"-->
                           <!--max="{//catalog/@maxprice}"/>-->
                    <!--<input name='maxPrice'-->
                           <!--type="number"-->
                           <!--step="0.05"-->
                           <!--value="{//catalog/@maxprice}"-->
                           <!--min="{//catalog/@minprice}"-->
                           <!--max="{//catalog/@maxprice}"/>-->
                    <!--<input class="submit_button" name="submit" type="submit" value="Search"/>-->
                <!--</form>-->
                <table>
                    <tr>
                        <th>ID</th>
                        <th>Author</th>
                        <th>Title</th>
                        <th>Genre</th>
                        <th>Price</th>
                        <th>Release Date</th>
                        <th>Description</th>
                    </tr>
                    <xsl:for-each select="catalog/book">
                        <xsl:sort select="*[name()=$sortColumnField]" data-type="{$sortColumnDataType}" order="ascending"/>
                        <xsl:if test="(
                        contains(title, //catalog/@title) and
                        contains(author, //catalog/@author) and
                        price >= //catalog/@minprice and price &lt;= //catalog/@maxprice
                        )">
                            <tr>
                                <td>
                                    <xsl:value-of select="@id"/>
                                </td>
                                <td>
                                    <xsl:value-of select="author"/>
                                </td>
                                <td>
                                    <xsl:value-of select="title"/>
                                </td>
                                <td>
                                    <xsl:value-of select="genre"/>
                                </td>
                                <td>
                                    <xsl:value-of select="price"/>
                                </td>
                                <td>
                                    <xsl:value-of select="publish_date"/>
                                </td>
                                <td>
                                    <xsl:value-of select="description"/>
                                </td>
                            </tr>
                        </xsl:if>
                    </xsl:for-each>
                </table>
            </body>
        </html>
    </xsl:template>
</xsl:stylesheet>

<?xml version="1.0" encoding="UTF-8" ?>
<xsl:stylesheet version="1.0" xmlns:xsl="http://www.w3.org/1999/XSL/Transform">
    <xsl:key name="Book-by-Author" match="book" use="author"/>
    <xsl:param name="sortColumnField" select="'title'"/>
    <xsl:param name="sortColumnOrder" select="'descending'"/>
    <xsl:param name="sortColumnDataType" select="'text'"/>


    <xsl:template match="/">
        <html>
            <body>
                <h2>Library <xsl:value-of select="/catalog/@foo" /></h2>
                <form >
                    <select name="author">
                        <xsl:for-each select="/catalog/book">
                            <option value="{author}">
                                <xsl:value-of select="author"/>

                            </option>
                        </xsl:for-each>
                    </select>
                    <input name="title" type="text" placeholder="Title"/>
                    <input name="minPrice" type="number" placeholder="min. Price" min="" max=""/>
                    <input name="maxPrice" type="number" placeholder="max. Price" min="" max=""/>

                    <select name="sort">
                        <xsl:for-each select="catalog/book[1]/*">
                            <option value="{name()}">
                                <xsl:value-of select="name()"/>

                            </option>
                        </xsl:for-each>
                    </select>

                    <input type="submit" value="Search"/>
                </form>
                <table border="1">
                    <tr>
                        <th><a href="">ID</a></th>
                        <th><a href="">Author</a></th>
                        <th><a href="">Title</a></th>
                        <th><a href="">Genre</a></th>
                        <th><a href="">Price</a></th>
                        <th><a href="">Release Date</a></th>
                        <th><a href="">Description</a></th>
                    </tr>
                    <xsl:for-each select="catalog/book">
                        <xsl:sort select="*[name()=$sortColumnField]" data-type="{$sortColumnDataType}" order="{$sortColumnOrder}"/>
                        <xsl:if test="(
                        contains(title, '') and
                        contains(author, '') and
                        price > 0 and price &lt; 100
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
